@extends('layout/masterLayout')
@section('title')
Trang chủ
@endsection
@push('style')
<style>
    .highcharts-container{
        font-family: inherit !important;
        font-size:14px !important;
    }
    svg.highcharts-root{
        font-family: inherit !important;
    }
</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$count_bill}}</h3>

                            <p>Đơn Hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('order.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$count_product}}</h3>

                            <p>Sản Phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-iphone"></i>
                        </div>
                        <a href="{{route('product.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$count_user}}</h3>

                            <p>Người Dùng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('user.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$count_post}}</h3>

                            <p>Bài viết</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-book-outline"></i>
                        </div>
                        <a href="{{route('post.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <section class="col-lg-8 connectedSortable ui-sortable">
                    <div class="card">
                        <figure class="highcharts-figure">
                            <div id="container">
                            </div>
                        </figure>
                    </div>
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                Đơn hàng mới
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Thông tin</th>
                                        <th>Tổng đơn</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($new_order as $new)
                                    <tr>
                                        <td style="text-align:center"><a href="{{route('order.detail',['id'=>$new->id])}}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">#{{$new->id}}</font></font></a></td>
                                        <td>
                                            Người nhận: {{$new->customer_name}}<br/>
                                            Điện thoại: {{$new->bill_phone}}
                                        </td>
                                        <td>
                                            {{number_format($new->bill_price,0,'','.')}} ₫
                                        </td>
                                        <td>
                                            @if($new->bill_status == 0)
                                                <span class="badge badge-warning">chờ xác nhận</span>
                                            @elseif ($new->bill_status == 1)
                                                <span class="badge badge-info">đã xác nhận</span>
                                            @elseif ($new->bill_status == 2)
                                                <span class="badge badge-success">đang giao hàng</span>
                                            @elseif ($new->bill_status == 3)
                                                <span class="badge badge-danger">giao thành công</span>
                                            @else
                                                <span class="badge badge-secondary">đã hủy</span>
                                            @endif
                                        </td>
                                        <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">{{$new->created_at}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix" style="background-color: rgba(0,0,0,.06);">
                            <a href="{{route('order.add')}}" class="btn btn-sm btn-info float-left">Thêm đơn hàng mới</a>
                            <a href="{{route('order.list')}}" class="btn btn-sm btn-secondary float-right">Xem tất cả đơn hàng</a>
                        </div>

                    </div>
                </section>
                <section class="col-lg-4 connectedSortable ui-sortable">
                    <div class="card">
                        <figure class="highcharts-figure">
                            <div id="container-2" data-json="{{$statusOrder}}">
                            </div>
                        </figure>
                    </div>
                    <div class="card bg-gradient-light">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-rocket" aria-hidden="true"></i>
                                Top sản phẩm bán chạy
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-light btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-light btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach ($top_product as $top)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{$top->product_image}}" alt="{{$top->product_name}}" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">
                                            {{$top->product_name}}
                                            <span class="badge badge-warning float-right">
                                                {{number_format($top->product_price,0,'','.')}} ₫
                                            </span>
                                        </a>
                                        <i class="product-description" style="font-size:14px;">
                                            {{$top->product_views}} lượt mua
                                        </i>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer clearfix text-center" style="background-color: rgba(0,0,0,.06);">
                            <a href="{{route('product.list')}}" class="uppercase"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Xem tất cả sản phẩm</font></font></a>
                        </div>
                    </div>
                </section>

                </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
</div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/variwide.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        Highcharts.chart('container', {
            chart: {
                type: 'variwide'
            },
            title: {
                text: 'Thống kê doanh thu các ngày trong tháng'
            },

            subtitle: {
                text: 'Source: <a href="http://ec.europa.eu/eurostat/web/' +
                    'labour-market/labour-costs/main-tables">eurostat</a>'
            },
            xAxis: {
                type: 'category'
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Labor Costs',
                data: [
                    ['Norway', 50.2, 335504],
                    ['Denmark', 42, 277339],
                    ['Belgium', 39.2, 421611],
                    ['Sweden', 38, 462057],
                    ['France', 35.6, 2228857],
                    ['Netherlands', 34.3, 702641],
                    ['Finland', 33.2, 215615],
                    ['Germany', 33.0, 3144050],
                    ['Austria', 32.7, 349344],
                    ['Ireland', 30.4, 275567],
                    ['Italy', 27.8, 1672438],
                    ['United Kingdom', 26.7, 2366911],
                    ['Spain', 21.3, 1113851],
                    ['Greece', 14.2, 175887],
                    ['Portugal', 13.7, 184933],
                    ['Czech Republic', 10.2, 176564],
                    ['Poland', 8.6, 424269],
                    ['Romania', 5.5, 169578]
                ],
                dataLabels: {
                    enabled: true,
                    format: '€{point.y:.0f}'
                },
                tooltip: {
                    pointFormat: 'Labor Costs: <b>€ {point.y}/h</b><br>' +
                        'GDP: <b>€ {point.z} million</b><br>'
                },
                colorByPoint: true
            }]
        });

    </script>
    <script type="text/javascript">
        let dataOrder = $('#container-2').attr('data-json');
        dataOrder = JSON.parse(dataOrder);
        Highcharts.chart('container-2', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'Thống kê trạng thái đơn hàng'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May']
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: dataOrder,
                showInLegend: true
            }]
        });
    </script>
@endpush
