@extends('layout/masterLayout')
@section('title')
    {{$title}}
@endsection
@push('style')
<style>
    tr, th{
        font-size:14px;
        text-align:center;
    }
    td, td a{
        text-align:center;
    }
    .card-header h3{
        text-align:center;
    }
    .card{
        margin-top:10px;
        box-shadow:0 0 1px black,
         0 1px 3px black;
    }
    .td-price{
       font-weight:bold;
    }
</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            @php
                use App\Models\Variantion;
                use App\Models\Propertie;
            @endphp
            <div class="row">
              <div class="card col-12">
                 <div class="card-header">
                    <h3>Thông tin đơn hàng </h3>
                 </div>
                 <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width:20%">Người nhận</th>
                            <th style="width:13%">Thông tin liên lạc</th>
                            <th style="width:15%" >Địa chỉ</th>
                            <th style="width:30%">Ghi chú</th>
                            <th style="width:14%">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{$bill->customer_name}}</td>
                                    <td>{{$bill->bill_phone}}</td>
                                    <td>{{$bill->address}}
                                        @if($bill->type == 1)
                                        , {{$bill->dist->name}}, {{$bill->city->name}}</td>
                                        @endif
                                    <td>
                                        @if($bill->note =='')
                                            Trống
                                        @else
                                            {{$bill->note}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bill->payment == 1)
                                            Thanh toán khi nhận hàng
                                        @else
                                            Thanh toán online
                                        @endif
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                 </div>
              </div>
              <div class="card col-12">
                <div class="card-header">
                   <h3>Chi tiết đơn hàng </h3>
                </div>
                <div class="card-body">
                   <table class="table table-bordered table-hover">
                       <thead>
                       <tr>
                           <th style="width:3%"></th>
                           <th style="width:25%">Sản phẩm</th>
                           <th style="width:15%">Đơn giá</th>
                           <th style="width:7%" >Số lượng</th>
                           <th style="width:15%">Thành tiền</th>
                       </tr>
                       </thead>
                       <tbody>
                        <?php
                        $i ='1';
                        $into_price = 0;
                        ?>
                           @foreach($details as $data)
                            <?php $into_price +=  $data->into_price?>
                               <tr>
                                   <td>#{{$i++}}</td>
                                   <td class="d-flex">
                                        <img width="100px" src="{{$data->product->product_image}}" style="padding-right:10px;" alt="">
                                        <div>
                                            <h6 style="color:Teal">{{$data->product->product_name}}</h6>
                                            <span style="color:Gray">
                                                @php
                                                    $html = '';
                                                    if($data->variant_id!=''){
                                                        $variant = Variantion::where('id', $data->variant_id)->first();
                                                        $propertie = Propertie::where('id', $variant->propertie_id)->first();
                                                        $html .= $propertie->propertie_value .' ';
                                                        if($variant->propertie_id_link!=null){
                                                            $arr_link = explode(' ', $variant->propertie_id_link);
                                                            $arr_search = array_search('', $arr_link);
                                                            unset($arr_link[$arr_search]);
                                                            foreach($arr_link as $arr_link){
                                                                $propertie_link = Propertie::where('id', $arr_link)->first();
                                                                $html .=  $propertie_link->propertie_value .' ';
                                                            }
                                                        }

                                                        echo $html ;
                                                    }
                                                @endphp
                                            </span>
                                        </div>
                                    </td>
                                   <td>{{number_format($data->price,0,'','.')}} ₫</td>
                                   <td>x{{$data->amount}}</td>
                                   <td>{{number_format($data->into_price,0,'','.')}} ₫</td>
                               </tr>

                           @endforeach
                           <tr>
                                <td colspan="4" class="td-price">Thành tiền</td>
                                <td>{{number_format($into_price,0,'','.')}} ₫</td>
                            </tr>
                           <tr>
                                <td colspan="4" class="td-price">Giảm giá</td>
                                <td>{{number_format($bill->sale,0,'','.')}} ₫</td>
                           </tr>
                           <tr>
                                <td colspan="4" class="td-price">Giá ship</td>
                                <td>{{number_format($bill->fee,0,'','.')}} ₫</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="td-price">Tổng tiền</td>
                                <?php $total = ($into_price - $bill->sale - $bill->fee); ?>
                                <td>{{number_format($total,0,'','.')}} ₫</td>
                            </tr>
                       </tbody>
                   </table>
                </div>
              </div>
            </div>

        </div>
@endsection
<script>

</script>

