<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Product;
use App\Models\Post;
use App\Helper\Date_Helper;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $count_bill = Bill::count();
        $count_product = Product::count();
        $count_user = User::count();
        $count_post = Post::count();
        // top sp bán nhiều
        $top_product = Product::where('product_display',1)->orderBy('product_views','desc')
                            ->limit(5)->get();
        // đơn hàng mới
        $new_order = Bill::orderBy('id','desc')->limit(7)->get();
        //thống kê doanh thu từng ngày
        $list_day = Date_Helper::getListDayInMonth();
        $turn_over = Bill::where('bill_status',3)->whereMonth('created_at',date('m'))
                        ->select(\DB::raw('sum(bill_price) as sum_price'), \DB::raw('DATE(created_at) day'))
                        ->groupBy('day')
                        ->get()->toArray();
        $arr_turn_over = [];
        foreach($list_day as $day){
            $total = 0;
            foreach($turn_over as $turn){
                if($turn['day'] === $day){
                    $total = $turn['sum_price'];
                    break;
                }
            }
            $arr_turn_over[] = (int)$total;
        }
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
            'count_bill'    => $count_bill,
            'count_product' => $count_product,
            'count_user'    => $count_user,
            'count_post'    => $count_post,
            'top_product'   => $top_product,
            'new_order'     => $new_order,
            'statusOrder'   => json_encode($statusOrder),
            'list_day'      => json_encode($list_day),
            'arr_turn_over' => json_encode($arr_turn_over),
        ]);
    }
}
