<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Product;
use App\Models\Post;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $count_bill = Bill::count();
        $count_product = Product::count();
        $count_user = User::count();
        $count_post = User::count();
        // top sp bán nhiều
        $top_product = Product::where('product_display',1)->orderBy('product_views','desc')
                            ->limit(5)->get();
        // đơn hàng mới
        $new_order = Bill::orderBy('id','desc')->limit(7)->get();
        // thống kê trạng thái đơn hàng
        $orderPending = Bill::where('bill_status',0)->select('id')->count();
        $orderProcessing = Bill::where('bill_status',1)->select('id')->count();
        $orderShipped = Bill::where('bill_status',2)->select('id')->count();
        $orderDelivered = Bill::where('bill_status',3)->select('id')->count();
        $orderCancel = Bill::where('bill_status',4)->select('id')->count();
        $statusOrder = [
            ['Chờ xác nhận',$orderPending , true, true],
            ['Đã xác nhận', $orderProcessing, false],
            ['Đang giao hàng', $orderShipped, false],
            ['Giao thành công', $orderDelivered, false],
            ['Đã hủy', $orderCancel, false],
        ];
        return view('pages.home',[
            'count_bill' => $count_bill,
            'count_product' => $count_product,
            'count_user' => $count_user,
            'count_post' => $count_post,
            'top_product'   => $top_product,
            'new_order' => $new_order,
            'statusOrder' => json_encode($statusOrder),
        ]);
    }
}
