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
        a.dropdown-item{
            padding: 0.5rem 1rem
        }
        a.dropdown-item i{
            padding-right:10px;
        }
    </style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="row" style="padding-top:15px;padding-bottom:15px;">
                    <div class="col-2">
                        <button type="button" class="btn btn-success"><a href="{{route('order.add')}}" style="color:#fff">+ Thêm mới</a></button>
                    </div>
                    <div class="col-7"></div>
                    <form action="" class="col-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">
                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:9%">Mã đơn hàng</th>
                        <th style="width:17%;text-align:left">Thông tin người nhận</th>
                        <th style="width:10%">Tổng tiền</th>
                        <th style="width:13%" >Hình thức thanh toán</th>
                        <th style="width:14%">Trạng thái</th>
                        <th style="width:18%">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($bill as $data)
                            <tr>
                                <td>#{{$data->id}}</td>
                                <td style="text-align:left">{{$data->customer_name}}
                                    @if ($data->customer_id )
                                        (Người dùng)
                                    @else
                                        (Khách vãng lai)
                                    @endif
                                    <br/>
                                    Điện thoại: {{$data->bill_phone}}
                                    <br/>
                                    Địa chỉ: {{$data->address}}
                                    @if ($data->type == 1)
                                        ,{{$data->dist->name}}, {{$data->city->name}}
                                    @endif
                                </td>
                                <td>{{number_format($data->bill_price,0,'','.')}} ₫</td>
                                <td>
                                    @if ($data->payment == 1)
                                        Thanh toán khi nhận hàng
                                    @else
                                        Thanh toán online
                                    @endif
                                </td>
                                <td>
                                    @if($data->bill_status == 0)
                                        <span class="badge badge-danger">chờ xác nhận</span>
                                    @elseif ($data->bill_status == 1)
                                        <span class="badge badge-info">đã xác nhận</span>
                                    @elseif ($data->bill_status == 2)
                                        <span class="badge badge-warning">đang giao hàng</span>
                                    @elseif ($data->bill_status == 3)
                                        <span class="badge badge-success">giao thành công</span>
                                    @else
                                        <span class="badge badge-secondary">đã hủy</span>
                                    @endif
                                </td>
                                <td style="text-align:left;">
                                    <a href="{{route('order.detail',[$data->id])}}" class="btn btn-dark btn-sm" style="border-color:black;">
                                        Xem chi tiết
                                    </a>
                                    @if ($data->bill_status==0)
                                        <div class="btn-group" style="padding-left:10px;">
                                            <button type="button" class="btn btn-info btn-sm">Thao tác</button>
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"><span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="{{route('order.update',['bill' =>$data->id])}}" class="dropdown-item" >
                                                        <i class="fas fa-edit" aria-hidden="true"></i> Sửa
                                                    </a>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['process', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-check" aria-hidden="true"></i> Xác nhận
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['shipped', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-truck" aria-hidden="true"></i>Giao hàng
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['delivered', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-handshake" aria-hidden="true"></i> Thành công
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['cancel', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-ban" aria-hidden="true"></i> Hủy
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @elseif ($data->bill_status==1)
                                        <div class="btn-group" style="padding-left:10px;">
                                            <button type="button" class="btn btn-info btn-sm">Thao tác</button>
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"><span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['shipped', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-truck" aria-hidden="true"></i>Giao hàng
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['delivered', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-handshake" aria-hidden="true"></i> Thành công
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['cancel', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-ban" aria-hidden="true"></i> Hủy
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @elseif ($data->bill_status==2)
                                        <div class="btn-group" style="padding-left:10px;">
                                            <button type="button" class="btn btn-info btn-sm">Thao tác</button>
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"><span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['delivered', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-handshake" aria-hidden="true"></i> Thành công
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-url="{{route('order.select',['cancel', $data->id])}}" class="dropdown-item select-order">
                                                        <i class="fa fa-ban" aria-hidden="true"></i> Hủy
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @else

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr/>
                {{-- {{$data->links()}} --}}
              </div>
            </div>
        </div>
@endsection
@push('scripts')
    <script>
        $('.select-order').click(function (e) {
            e.preventDefault();
            url = $(this).data('url');
            console.log(url);
            Swal.fire({
                title: 'Bạn có muốn?',
                text: "Thay đổi trạng thái",
                showCancelButton: true,
                confirmButtonText: 'Vâng',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function () {
                    location.reload();
                    Swal.fire(
                        'Cập Nhật Thành Công',
                        '',
                        'success'
                    )
                    },
                    error: function () {
                    Swal.fire({
                        icon: 'error',
                        text: 'Đã có lỗi xảy ra',
                    })
                    }
                });
                }
            })
        });
    </script>
@endpush
