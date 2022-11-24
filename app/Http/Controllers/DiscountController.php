<?php

namespace App\Http\Controllers;

use App\Http\Requests\Promotion\Discount\AddDiscountRequest;
use App\Http\Requests\Promotion\Discount\UpdateDiscountRequest;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\PromotionProduct;
use Faker\Extension\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class DiscountController extends Controller
{
    /**
     * getAdd
     *
     * @return void
     */
    public function index()
    {
        Session::forget('dataSessionProductDiscount');
        $discountnotstart = Promotion::where('type', 'discount')->where('promotion_status', 0)->get();
        $discount = Promotion::where('type', 'discount')->where('promotion_status', 1)->get();
        $discountend = Promotion::where('type', 'discount')->where('promotion_status', 2)->get();
        $dataDiscount = PromotionProduct::select('promotion_id_product', 'promotion_id')->with(['promotion', 'product'])->whereRelation('promotion', 'type', '=', 'discount')->whereRelation('promotion', 'promotion_status', 1)->get();
        $dataDiscountNotStart = PromotionProduct::select('promotion_id_product', 'promotion_id')->with(['promotion', 'product'])->whereRelation('promotion', 'type', '=', 'discount')->whereRelation('promotion', 'promotion_status', 0)->get();
        $dataDiscountEnd = PromotionProduct::select('promotion_id_product', 'promotion_id')->with(['promotion', 'product'])->whereRelation('promotion', 'type', '=', 'discount')->whereRelation('promotion', 'promotion_status', 2)->get();
        return view('pages.promotion.discount.list', compact('discount', 'discountend', 'discountnotstart', 'dataDiscount', 'dataDiscountNotStart', 'dataDiscountEnd'));
    }

    /**
     * dataSession for dataTables
     *
     * @return Array
     */
    public function dataSession(Request $request)
    {
        // Session::forget('dataSessionProductDiscount');

        if (Session::has('dataSessionProductDiscount')) {
            if (count(Session::get('dataSessionProductDiscount')) <= 0) {
                Session::forget('dataSessionProductDiscount');
            }
            $data['data'] = Session::get('dataSessionProductDiscount');
            // Session::forget('dataSessionProductDiscount');
        } else {
            if ($request->has('edit') && $request->ajax()) {
                $id_promotion = $request->edit;
                $promotion_product = PromotionProduct::select('promotion_id_product', 'promotion_id')
                    ->with(['promotion', 'product'])
                    ->whereRelation('promotion', 'type', '=', 'discount')
                    ->where('promotion_id', $id_promotion)
                    ->get();
                $session = Session::get('dataSessionProductDiscount');
                foreach ($promotion_product as $k => $promo) {
                    $session[$k] = $promo->product;
                }
                Session::put('dataSessionProductDiscount', $session);
                $data['data'] = $session;
            } else {
                $data['data'] = null;
            }
        }
        return $data;
    }
    /**
     * addDataSesion
     *
     * @return Array
     */
    public function addDataSession(Request $request)
    {
        if ($request->ajax() && $request->idProduct) {
            $idProduct = $request->idProduct;
            $products = Product::whereIn('id', $idProduct)->get();
            Session::put('dataSessionProductDiscount', $products);
            return true;
        }
    }
    /**
     * delete data session
     *
     * @param  Product $product
     * @return void
     */
    public function deleteDataSession(Product $product)
    {
        $products = Session::get('dataSessionProductDiscount');
        $arr=collect();
        foreach ($products as $k => $pr) {
            if ($pr->id != $product->id) {
                $arr->push($pr);
            }
        }
        if (count(Session::get('dataSessionProductDiscount')) <= 0) {
            Session::forget('dataSessionProductDiscount');
        } else {
                Session::put('dataSessionProductDiscount', ($arr));
            // Session::put('dataSessionProductDiscount', ($products->values()));
        }
        return back();
    }
    /**
     * dataProductAll for dataTables
     *
     * @return Array
     */
    public function dataProductAll()
    {
        $promotions = PromotionProduct::select('promotion_id_product')->with(['promotion', 'product'])->whereRelation('promotion', 'type', '=', 'discount')->whereHas('promotion', function (Builder $query) {
            $query->whereIn('promotion_status', [0, 1]);
        })->get();
        $arrPromotion = $arrSession = [];
        foreach ($promotions as $v) {
            array_push($arrPromotion, $v->promotion_id_product);
        }
        $data['data'] = Product::all();
        if (Session::has('dataSessionProductDiscount')) {
            $session = Session::get('dataSessionProductDiscount');
            foreach ($session as $v) {
                array_push($arrSession, $v->id);
            }
        }
        foreach ($data['data'] as $dt) {
            $dt->arrPromotion = json_encode($arrPromotion);
            $dt->arrSession = json_encode($arrSession);
        }
        return $data;
    }
    public function changeMoney(Request $request)
    {
        if (Session::has('dataSessionProductDiscount')) {
            $session = Session::get('dataSessionProductDiscount');
            $arrMoney = [];
            foreach ($session as $sess) {
                if ($request->type == 0) {
                    array_push($arrMoney, ((100 - $request->rate) / 100) * $sess->product_price);
                } else {
                    array_push($arrMoney, $sess->product_price - $request->rate);
                }
            }
        }
        return json_encode($arrMoney);
    }
    /**
     * show detailed discount
     *
     * @param  Promotion $discount
     * @return void
     */
    public function show(Promotion $discount)
    {
        $promotion_product = PromotionProduct::select('promotion_rate')->where('promotion_id', $discount->id)->first();
        return view('pages.promotion.discount.edit', compact('discount', 'promotion_product'));
    }

    /**
     * create
     *
     * @return void
     */
    public function getAdd()
    {
        return view('pages.promotion.discount.add');
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
            $dateRanges = explode(' - ', $request->discout_daterange);
            $converts = convertStringToDate($dateRanges[0], $dateRanges[1]);
            //check time start
            $discount_status = diffTimeNow($converts[0], $converts[1]);
            $promotionData = [
                'promotion_name' => $request->discout_name,
                'promotion_datestart' => $converts[0],
                'promotion_dateend' => $converts[1],
                'promotion_type' => $request->discount_type,
                'promotion_status' => $discount_status,
                'promotion_numer_of_use' => $request->discout_numberofuse,
                'type' => 'discount',
            ];
            $promotion = Promotion::create($promotionData);
            $session = Session::get('dataSessionProductDiscount');
            foreach ($session as $v) {
                DB::table('promotion_products')->insert([
                    'promotion_id' => $promotion->id,
                    'promotion_id_product' => $v->id,
                    'promotion_rate' => $request->discout_rate,
                ]);
                Product::where('id',$v->id)->update(['is_discount_product'=>$discount_status]);
            }
            Session::forget('dataSessionProductDiscount');
            return redirect(route('promotion.discount.list'))->with('success', trans('alert.add.success'));
        });
    }

    /**
     * update
     *
     * @param  Promotion $discountcode
     * @param  UpdateDiscountRequest $request
     * @return void
     */
    public function update(Promotion $discount, UpdateDiscountRequest $request)
    {
        return DB::transaction(function () use ($request, $discount) {
            $dateRanges = explode(' - ', $request->discout_daterange);

            $converts = convertStringToDate($dateRanges[0], $dateRanges[1]);
            //check time start
            $discount_status = diffTimeNow($converts[0], $converts[1]);
            $discount->promotion_name = $request->discout_name;
            $discount->promotion_datestart = $converts[0];
            $discount->promotion_dateend = $converts[1];
            $discount->promotion_type = $request->discount_type;
            $discount->promotion_status = $discount_status;
            $discount->promotion_numer_of_use = $request->discout_numberofuse;
            $discount->type = 'discount';
            $discount->save();
            $session = Session::get('dataSessionProductDiscount');
            PromotionProduct::where('promotion_id',$discount->id)->delete();
            foreach ($session as $v) {
                DB::table('promotion_products')->insert([
                    'promotion_id' => $discount->id,
                    'promotion_id_product' => $v->id,
                    'promotion_rate' => $request->discout_rate,
                ]);
                Product::where('id',$v->id)->update(['is_discount_product'=>$discount_status]);
            }
            Session::forget('dataSessionProductDiscount');
            return redirect(route('promotion.discount.list'))->with('success', trans('alert.update.success'));
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
        $promotion_product= PromotionProduct::where('promotion_id',$id)->get();
        foreach ($promotion_product as $prom){
            Product::where('id',$prom->promotion_id_product)->update(['is_discount_product'=>0]);
        }
        $promotion = Promotion::find($id);
        $promotion->promotion_dateend = date('Y-m-d H:i:s');
        $promotion->promotion_status = 2;
        $promotion->save();
    }
}
