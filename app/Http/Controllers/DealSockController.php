<?php

namespace App\Http\Controllers;

use App\Http\Requests\Promotion\DealSock\AddDealSockRequest;
use App\Http\Requests\Promotion\DealSock\UpdateDealSockRequest;
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

class DealSockController extends Controller
{
    /**
     * getAdd
     *
     * @return void
     */
    public function index()
    {
        Session::forget('dataSessionProductDealsock');
        Session::forget('dataSessionProductDealsockCombo');
        $dealsocknotstart = Promotion::where('type', 'deal-sock')->where('promotion_status', 0)->get();
        $dealsock = Promotion::where('type', 'deal-sock')->where('promotion_status', 1)->get();
        $dealsockend = Promotion::where('type', 'deal-sock')->where('promotion_status', 2)->get();
        $dataDealSock = PromotionProduct::select('promotion_id_product', 'promotion_id_product_combo', 'promotion_id')->with(['promotion', 'product'])->whereRelation('promotion', 'type', '=', 'deal-sock')->whereRelation('promotion', 'promotion_status', 1)->get();
        $dataDealSockNotStart = PromotionProduct::select('promotion_id_product', 'promotion_id_product_combo', 'promotion_id')->with(['promotion', 'product'])->whereRelation('promotion', 'type', '=', 'deal-sock')->whereRelation('promotion', 'promotion_status', 0)->get();
        $dataDealSockEnd = PromotionProduct::select('promotion_id_product', 'promotion_id_product_combo', 'promotion_id')->with(['promotion', 'product'])->whereRelation('promotion', 'type', '=', 'deal-sock')->whereRelation('promotion', 'promotion_status', 2)->get();
        return view('pages.promotion.dealsock.list', compact('dealsock', 'dealsockend', 'dealsocknotstart', 'dataDealSock', 'dataDealSockNotStart', 'dataDealSockEnd'));
    }

    /**
     * dataSession for dataTables
     *
     * @return Array
     */
    public function dataSession(Request $request)
    {
        // Session::forget('dataSessionProductDealsock');
        if (Session::has('dataSessionProductDealsock')) {
            if (count(Session::get('dataSessionProductDealsock')) <= 0) {
                Session::forget('dataSessionProductDealsock');
            }
            $data['data'] = Session::get('dataSessionProductDealsock');
            // Session::forget('dataSessionProductDealsock');
        } else {
            if ($request->has('edit') && $request->ajax()) {
                $id_promotion = $request->edit;
                $promotion_product = PromotionProduct::select('promotion_id_product','promotion_rate', 'promotion_id')
                    ->with(['promotion', 'product'])
                    ->whereRelation('promotion', 'type', '=', 'deal-sock')
                    ->where('promotion_id', $id_promotion)
                    ->get();
                $session = Session::get('dataSessionProductDealsock');
                foreach ($promotion_product as $k => $promo) {
                    if ($k == 0) {
                        $session[$k] = $promo->product;
                       $session[$k]['rate'] = $promo->promotion_rate;
                    }
                }
                Session::put('dataSessionProductDealsock', $session);
                $data['data'] = $session;
            } else {
                $data['data'] = null;
            }
        }
        return $data;
    }
    /**
     * dataSession for dataTables
     *
     * @return Array
     */
    public function dataSessionCombo(Request $request)
    {
        // Session::forget('dataSessionProductDealsockCombo');
        if (Session::has('dataSessionProductDealsockCombo')) {
            if (count(Session::get('dataSessionProductDealsockCombo')) <= 0) {
                Session::forget('dataSessionProductDealsockCombo');
            }
            $data['data'] = Session::get('dataSessionProductDealsockCombo');
            // Session::forget('dataSessionProductDealsockCombo');
        } else {
            if ($request->has('editCombo') && $request->ajax()) {
                $id_promotion = $request->editCombo;
                $promotion_product = PromotionProduct::select('promotion_rate_combo','promotion_id_product_combo', 'promotion_id')
                    ->with(['promotion', 'productCombo'])
                    ->whereRelation('promotion', 'type', '=', 'deal-sock')
                    ->where('promotion_id', $id_promotion)
                    ->get();
                $session = Session::get('dataSessionProductDealsockCombo');
                foreach ($promotion_product as $k => $promo) {
                    $session[$k] = $promo->productCombo;
                    $session[$k]['rate'] = $promo->promotion_rate_combo;
                }
                Session::put('dataSessionProductDealsockCombo', $session);
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
            $products = Product::where('id', $idProduct)->get();
            Session::put('dataSessionProductDealsock', $products);
            return true;
        }
    }
    /**
     * addDataSesion
     *
     * @return Array
     */
    public function addDataSessionCombo(Request $request)
    {
        if ($request->ajax() && $request->idProduct) {
            $idProduct = $request->idProduct;
            $products = Product::whereIn('id', $idProduct)->get();
            Session::put('dataSessionProductDealsockCombo', $products);
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

        $products = Session::get('dataSessionProductDealsock');
        $arr = collect();
        foreach ($products as $k => $pr) {
            if ($pr->id != $product->id) {
                $arr->push($pr);
            }
        }
        if (count(Session::get('dataSessionProductDealsock')) <= 0) {
            Session::forget('dataSessionProductDealsock');
        } else {
            Session::put('dataSessionProductDealsock', ($arr));
            // Session::put('dataSessionProductDealsock', ($products->values()));
        }
        return back();
    }
    /**
     * delete data session
     *
     * @param  Product $product
     * @return void
     */
    public function deleteDataSessionCombo(Product $product)
    {
        $products = Session::get('dataSessionProductDealsockCombo');
        $arr = collect();
        foreach ($products as $k => $pr) {
            if ($pr->id != $product->id) {
                $arr->push($pr);
            }
        }
        if (count(Session::get('dataSessionProductDealsockCombo')) <= 0) {
            Session::forget('dataSessionProductDealsockCombo');
        } else {
            Session::put('dataSessionProductDealsockCombo', ($arr));
            // Session::put('dataSessionProductDealsockCombo', ($products->values()));
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
        $promotions = PromotionProduct::select('promotion_id_product')->with(['promotion', 'product'])->whereRelation('promotion', 'type', '!=', 'discount-code')->whereHas('promotion', function (Builder $query) {
            $query->whereIn('promotion_status', [0, 1]);
        })->get();
        $arrPromotion = $arrSession = [];
        foreach ($promotions as $v) {
            array_push($arrPromotion, $v->promotion_id_product);
        }
        $data['data'] = Product::with('productCategory')->whereRelation('productCategory', 'category_slug', '=', 'dien-thoai')->get();
        if (Session::has('dataSessionProductDealsock')) {
            $session = Session::get('dataSessionProductDealsock');
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
    /**
     * dataProductAll for dataTables
     *
     * @return Array
     */
    public function dataProductAllCombo()
    {
        $arrSession = [];
        $data['data'] = Product::with('productCategory')->whereRelation('productCategory', 'category_slug', '=', 'phu-kien')->get();
        if (Session::has('dataSessionProductDealsockCombo')) {
            $session = Session::get('dataSessionProductDealsockCombo');
            foreach ($session as $v) {
                array_push($arrSession, $v->id);
            }
        }
        foreach ($data['data'] as $dt) {
            $dt->arrSession = json_encode($arrSession);
        }
        return $data;
    }
    /**
     * show detailed discount
     *
     * @param  Promotion $discount
     * @return void
     */
    public function show(Promotion $dealsock)
    {

        $promotion_product = PromotionProduct::select('promotion_rate')->where('promotion_id', $dealsock->id)->first();
        return view('pages.promotion.dealsock.edit', compact('dealsock', 'promotion_product'));
    }

    /**
     * create
     *
     * @return void
     */
    public function getAdd()
    {
        return view('pages.promotion.dealsock.add');
    }
    /**
     * store
     *
     * @param  AddDealSockRequest $request
     * @return void
     */
    public function store(AddDealSockRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $dateRanges = explode(' - ', $request->dealsock_daterange);
            $converts = convertStringToDate($dateRanges[0], $dateRanges[1]);
            //check time start
            $dealsock_status = diffTimeNow($converts[0], $converts[1]);
            $promotionData = [
                'promotion_name' => $request->dealsock_name,
                'promotion_datestart' => $converts[0],
                'promotion_dateend' => $converts[1],
                'promotion_type' => $request->dealsock_type,
                'promotion_status' => $dealsock_status,
                'promotion_numer_of_use' => $request->dealsock_numberofuse,
                'type' => 'deal-sock',
            ];
            $promotion = Promotion::create($promotionData);
            $session = Session::get('dataSessionProductDealsock')[0];
            $sessionCombo = Session::get('dataSessionProductDealsockCombo');
            foreach ($sessionCombo as $k => $v) {
                DB::table('promotion_products')->insert([
                    'promotion_id' => $promotion->id,
                    'promotion_id_product' => $session->id,
                    'promotion_id_product_combo' => $v->id,
                    'promotion_rate' => $request->mucgiam,
                    'promotion_rate_combo' => $request->mucgiamcombo[$k],
                ]);
            }
            Product::where('id', $session->id)->update(['is_discount_product' => $dealsock_status]);
            Session::forget('dataSessionProductDealsock');
            Session::forget('dataSessionProductDealsockCombo');
            return redirect(route('promotion.dealsock.list'))->with('success', trans('alert.add.success'));
        });
    }

    /**
     * update
     *
     * @param  Promotion $discountcode
     * @param  UpdateDealSockRequest $request
     * @return void
     */
    public function update(Promotion $dealsock, UpdateDealSockRequest $request)
    {
        return DB::transaction(function () use ($request, $dealsock) {
            $dateRanges = explode(' - ', $request->dealsock_daterange);
            $converts = convertStringToDate($dateRanges[0], $dateRanges[1]);
            //check time start
            $dealsock_status = diffTimeNow($converts[0], $converts[1]);
            $dealsock->promotion_name = $request->dealsock_name;
            $dealsock->promotion_datestart = $converts[0];
            $dealsock->promotion_dateend = $converts[1];
            $dealsock->promotion_type = $request->dealsock_type;
            $dealsock->promotion_status = $dealsock_status;
            $dealsock->promotion_numer_of_use = $request->dealsock_numberofuse;
            $dealsock->type = 'deal-sock';
            $dealsock->save();
            $session = Session::get('dataSessionProductDealsock')[0];
            PromotionProduct::where('promotion_id', $dealsock->id)->delete();
            $sessionCombo = Session::get('dataSessionProductDealsockCombo');
            foreach ($sessionCombo as $k => $v) {
                DB::table('promotion_products')->insert([
                    'promotion_id' => $dealsock->id,
                    'promotion_id_product' => $session->id,
                    'promotion_id_product_combo' => $v->id,
                    'promotion_rate' => $request->mucgiam,
                    'promotion_rate_combo' => $request->mucgiamcombo[$k],
                ]);
            }
            Product::where('id', $session->id)->update(['is_discount_product' => $dealsock_status]);
            Session::forget('dataSessionProductDealsock');
            Session::forget('dataSessionProductDealsockCombo');
            return redirect(route('promotion.dealsock.list'))->with('success', trans('alert.update.success'));
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
        $promotion_product = PromotionProduct::where('promotion_id', $id)->get();
        foreach ($promotion_product as $prom) {
            Product::where('id', $prom->promotion_id_product)->update(['is_discount_product' => 0]);
        }
        $promotion = Promotion::find($id);
        $promotion->promotion_dateend = date('Y-m-d H:i:s');
        $promotion->promotion_status = 2;
        $promotion->save();
    }
}
