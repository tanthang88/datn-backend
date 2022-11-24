<?php

namespace App\Http\Controllers;

use App\Http\Requests\Promotion\DiscountCode\AddDiscountRequest;
use App\Http\Requests\Promotion\DiscountCode\UpdateDiscountRequest;
use App\Models\Promotion;
use App\Models\PromotionProduct;
use Faker\Extension\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    /**
     * getAdd
     *
     * @return void
     */
    public function index()
    {
        $discountcodenotstart = Promotion::where('type', 'discount-code')->where('promotion_status', 0)->get();
        $discountcode = Promotion::where('type', 'discount-code')->where('promotion_status', 1)->get();
        $discountcodeend = Promotion::where('type', 'discount-code')->where('promotion_status', 2)->get();
        return view('pages.promotion.discount-code.list', compact('discountcode', 'discountcodeend','discountcodenotstart'));
    }

    /**
     * dataDiscountCodes for dataTables
     *
     * @return Array
     */
    public function dataDiscountCodes()
    {
        $data['data'] = Promotion::where('type', 'discount-code')->where('promotion_status', 1)->with('promotionProduct')->get();
        return $data;
    }
    /**
     * dataDiscountCodesEnd for dataTables
     *
     * @return Array
     */
    public function dataDiscountCodesEnd()
    {
        $data['data'] = Promotion::where('type', 'discount-code')->where('promotion_status', 2)->with('promotionProduct')->get();
        return $data;
    }
     /**
     * dataDiscountCodesNotStart for dataTables
     *
     * @return Array
     */
    public function dataDiscountCodesNotStart()
    {
        $data['data'] = Promotion::where('type', 'discount-code')->where('promotion_status', 0)->with('promotionProduct')->get();
        return $data;
    }
     /**
     * show detailed discount code
     *
     * @param  Promotion $discountcode
     * @return void
     */
    public function show(Promotion $discountcode)
    {
        $promotion_product=PromotionProduct::select('promotion_code','promotion_rate','promotion_order_value')->where('promotion_id',$discountcode->id)->first();
        return view('pages.promotion.discount-code.edit', compact('discountcode','promotion_product'));
    }

    /**
     * create
     *
     * @return void
     */
    public function getAdd()
    {
        return view('pages.promotion.discount-code.add');
    }
    /**
     * store
     *
     * @param  AddDiscountRequest $request
     * @return void
     */
    public function store(AddDiscountRequest $request)
    {
        return DB::transaction(function () use ($request) {
          $dateRanges = explode(' - ', $request->discoutcode_daterange);
          $converts=convertStringToDate($dateRanges[0],$dateRanges[1]);
            //check time start
           $discountcode_status= diffTimeNow($converts[0],$converts[1]);
            $promotionData = [
                'promotion_name' => $request->discoutcode_name,
                'promotion_datestart' => $converts[0],
                'promotion_dateend' => $converts[1],
                'promotion_type' => $request->discountcode_type,
                'promotion_status' => $discountcode_status,
                'promotion_numer_of_use' =>$request->discoutcode_numberofuse,
                'type' =>'discount-code',
            ];
            $promotion = Promotion::create($promotionData);
            DB::table('promotion_products')->insert([
                'promotion_id' => $promotion->id,
                'promotion_code' =>$request->discoutcode_code,
                'promotion_rate' => $request->discoutcode_rate,
                'promotion_order_value' => $request->discoutcode_ordervalue,
            ]);
            return redirect(route('promotion.discount-code.list'))->with('success', trans('alert.add.success'));
        });
    }

    /**
     * update
     *
     * @param  Promotion $discountcode
     * @param  UpdateDiscountRequest $request
     * @return void
     */
    public function update(Promotion $discountcode, UpdateDiscountRequest $request)
    {
        return DB::transaction(function () use ($request, $discountcode) {
            $dateRanges = explode(' - ', $request->discoutcode_daterange);

             $converts=convertStringToDate($dateRanges[0],$dateRanges[1]);
            //check time start
              $discountcode_status= diffTimeNow($converts[0],$converts[1]);
              $discountcode->promotion_name = $request->discoutcode_name;
              $discountcode->promotion_datestart = $converts[0];
              $discountcode->promotion_dateend = $converts[1];
              $discountcode->promotion_type = $request->discountcode_type;
              $discountcode->promotion_status = $discountcode_status;
              $discountcode->promotion_numer_of_use =$request->discoutcode_numberofuse;
              $discountcode->save();
            DB::table('promotion_products')->where('promotion_id',$discountcode->id)->update([
                'promotion_code' =>$request->discoutcode_code,
                'promotion_rate' => $request->discoutcode_rate,
                'promotion_order_value' => $request->discoutcode_ordervalue,
            ]);
            return back()->with('success', trans('alert.update.success'));
        });
    }

    /**
     * delete
     *
     * @param  Promotion $discountcode
     * @return void
     */
    public function delete($id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete();
    }
     /**
     * delete
     *
     * @param  Promotion $discountcode
     * @return void
     */
    public function end($id)
    {
        $promotion = Promotion::find($id);
        $promotion->promotion_dateend=date('Y-m-d H:i:s');
        $promotion->promotion_status=2;
        $promotion->save();
    }
}
