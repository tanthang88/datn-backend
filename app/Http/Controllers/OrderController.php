<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\City;
use App\Models\Dist;
use App\Models\Product;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $bill = Bill::orderBy('id', 'desc')->get();
        return view('pages.order.list',[
            'title'      => 'Danh sách đơn hàng',
            'bill'       =>  $bill,
        ]);
    }
    public function select($select, $id)
    {
        $bill = Bill::find($id);
        if($bill) {
            switch ($select) {
                case 'process':
                    $bill->bill_status = 1;
                    break;
                case 'shipped':
                    $bill->bill_status = 2;
                    break;
                case 'delivered':
                    $bill->bill_status = 3;
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
                $id_product = $request->edit;
                $bill_details = BillDetail::select('product_id')
                    ->with(['product'])
                    ->where('product_id', $id_product)
                    ->get();
                $session = Session::get('dataSessionProduct');
                foreach ($bill_details as $k => $promo) {
                    $session[$k] = $promo->product;
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
        $arr=collect();
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
        $cities = Dist::where('code',$id)->get();
        return response()->json($cities);
    }
    public function create()
    {
        $city = City::orderBy('id','asc')->get();
        return view('pages.order.add',[
            'title' => 'Thêm đơn hàng',
            'city' => $city,
        ]);
    }
    public function store(Request $request)
    {
        // lưu đơn hàng
        $order = new Bill;
        $order->customer_id = 1;
        $order->bill_phone = $request->bill_phone;
        $order->customer_name = $request->customer_name;
        $order->address = $request->address;
        $order->city_id = 32 ;
        $order->dist_id = 355;
        $order->sale = 0;
        $order->fee = 0;
        $order->bill_price = $request->total;
        $order->type = $request->type;
        $order->payment = $request->payment;
        $order->bill_status = 1;
        $order->save();
        // lưu detail
        foreach($request->price as $index => $value){
            $detail = new BillDetail;
            $detail->bill_id = $order->id;
            $detail->product_id=$request->product_id[$index];
            $detail->price = $request->price[$index];
            $detail->amount = $request->amount[$index];
            $detail->into_price = $request->into_price[$index];
            // tách chuỗi variant_id
           if($request->variant_id[$index] != null){
                $str_variant_id = $request->variant_id[$index];
                $arr_variant_id = explode(' ', $str_variant_id);
                $detail->variant_id = $arr_variant_id[0];
           }
           $detail->save();
        }
        Session::forget('dataSessionProduct');
        return redirect(route('order.list'))->with('success', trans('alert.add.success'));
    }
    public function show($id)
    {
        $bill = Bill::orderBy('id', 'desc')->where('id', $id)->first();
        $details = BillDetail::where('bill_id', $id)->orderBy('id', 'desc')->get();
        return view('pages.order.detail',[
            'title'      => 'Đơn hàng chi tiết',
            'bill'       =>  $bill,
            'details'       =>  $details,
        ]);
    }
    // public function print($checkId)
    // {
    //     $pdf = \App::make('dompdf.wrapper');
    //     $pdf->loadHTML($this->printConvert($checkId));
    //     return $pdf->stream();
    // }
    // public function printConvert($checkId)
    // {
    //     return $checkId;
    // }
}
