<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\AddOrderRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\City;
use App\Models\Dist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $bill = Bill::orderBy('id', 'desc')->paginate(config('define.pagination.per_page'));
        Session::forget('dataSessionProduct');
        return view('pages.order.list', [
            'title' => 'Danh sách đơn hàng',
            'bill' => $bill,
        ]);
    }
    public function select($select, $id)
    {
        $bill = Bill::find($id);
        if ($bill) {
            switch ($select) {
                case 'process':
                    $bill->bill_status = 1;
                    break;
                case 'shipped':
                    $bill->bill_status = 2;
                    break;
                case 'delivered':
                    $bill->bill_status = 3;
                    $details = BillDetail::where('bill_id', $bill->id)->orderBy('id', 'desc')->get();
                    foreach ($details as $key => $value) {
                        $product = Product::find($value->product_id);
                        if ($product) {
                            $quantity = $product->product_quantity;
                            $update_quantity = $quantity - $value->amount;
                            $product->product_quantity = $update_quantity;
                            $product->product_views += $value->amount;
                        }
                        $product->update();
                    }
                    break;
                case 'cancel':
                    $bill->bill_status = 4;
                    break;
            }
        }
        $bill->update();
    }
    public function dataSession(Request $request)
    {

        if (Session::has('dataSessionProduct')) {
            if (count(Session::get('dataSessionProduct')) <= 0) {
                Session::forget('dataSessionProduct');
            }
            $data['data'] = Session::get('dataSessionProduct');
        } else {
            if ($request->has('edit') && $request->ajax()) {
                $bill_id = $request->edit;
                $bill_details = BillDetail::join('products', 'products.id', '=', 'bill_details.product_id')
                    ->where('bill_id', $bill_id)
                    ->get();
                $session = Session::get('dataSessionProduct');
                foreach ($bill_details as $k => $promo) {
                    $session[] = $promo;
                }
                Session::put('dataSessionProduct', $session);
                $data['data'] = $session;
            } else {
                $data['data'] = null;
            }
        }
        return $data;
    }
    public function addDataSession(Request $request)
    {
        if ($request->ajax() && $request->idProduct) {
            $idProduct = $request->idProduct;
            $products = Product::whereIn('id', $idProduct)->get();
            Session::put('dataSessionProduct', $products);
            return true;
        }
    }
    public function deleteDataSession(Product $product)
    {
        $products = Session::get('dataSessionProduct');
        $arr = collect();
        foreach ($products as $k => $pr) {
            if ($pr->id != $product->id) {
                $arr->push($pr);
            }
        }
        if (count(Session::get('dataSessionProduct')) <= 0) {
            Session::forget('dataSessionProduct');
        } else {
            Session::put('dataSessionProduct', ($arr));
        }
        return back();
    }
    public function dataProductAll()
    {
        $order_details = BillDetail::select('product_id')->rightJoin('products', 'products.id', '=', 'bill_details.product_id')->where('product_display', 1)->get();
        $arrOrder = $arrSession = [];
        foreach ($order_details as $v) {
            array_push($arrOrder, $v->promotion_id_product);
        }
        $data['data'] = Product::all();
        if (Session::has('dataSessionProduct')) {
            $session = Session::get('dataSessionProduct');
            foreach ($session as $v) {
                array_push($arrSession, $v->id);
            }
        }
        foreach ($data['data'] as $dt) {
            $dt->arrOrder = json_encode($arrOrder);
            $dt->arrSession = json_encode($arrSession);
        }
        return $data;
    }
    public function selectDist($id)
    {
        $cities = Dist::where('code', $id)->get();
        return response()->json($cities);
    }
    public function create()
    {
        $city = City::orderBy('id', 'asc')->get();
        $dist = Dist::where('code', 48)->get();
        return view('pages.order.add', [
            'title' => 'Thêm đơn hàng',
            'city' => $city,
            'dist' => $dist,
        ]);
    }
    public function store(AddOrderRequest $request)
    {
        // lưu đơn hàng
        $order = new Bill;
        $order->customer_id = null;
        $order->bill_phone = $request->bill_phone;
        $order->customer_name = $request->customer_name;
        $order->address = $request->address;
        $order->city_id = $request->city_id;
        $order->dist_id = $request->dist_id;
        $order->sale = 0;
        $order->fee = 0;
        $order->bill_price = $request->total;
        $order->type = $request->type;
        $order->payment = $request->payment;
        $order->bill_status = 0;
        $order->save();
        // lưu detail
        foreach ($request->price as $index => $value) {
            $detail = new BillDetail;
            $detail->bill_id = $order->id;
            $detail->product_id = $request->product_id[$index];
            $detail->price = $request->price[$index];
            $detail->product_name = $request->product_name[$index];
            $detail->product_image = $request->product_image[$index];
            $detail->amount = $request->amount[$index];
            $detail->into_price = $request->into_price[$index];
            // tách chuỗi variant_id
            if ($request->variant_id[$index] != null) {
                $str_variant_id = $request->variant_id[$index];
                $arr_variant_id = explode(' ', $str_variant_id);
                $detail->variant_id = $arr_variant_id[0];
                $detail->variant_name = $request->variant_name[$index];
            }
            $detail->save();
        }
        Session::forget('dataSessionProduct');
        return redirect(route('order.list'))->with('success', trans('alert.add.success'));
    }
    public function detail($id)
    {
        $bill = Bill::orderBy('id', 'desc')->where('id', $id)->first();
        $details = BillDetail::where('bill_id', $id)->orderBy('id', 'desc')->get();
        return view('pages.order.detail', [
            'title' => 'Đơn hàng chi tiết',
            'bill' => $bill,
            'details' => $details,
        ]);
    }
    public function show(Bill $bill)
    {
        $detail = BillDetail::find($bill);
        $city = City::get();
        $code_city = City::find($bill->city_id);
        $dist = Dist::where('code', $code_city->code)->get();
        return view('pages.order.update', [
            'title' => 'Chỉnh sửa đơn hàng',
            'bill' => $bill,
            'detail' => $detail,
            'city' => $city,
            'dist' => $dist,
        ]);
    }

}
