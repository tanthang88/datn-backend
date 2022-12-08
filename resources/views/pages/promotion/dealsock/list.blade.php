@extends('layout/masterLayout')
@section('title')
Chương trình khuyến mãi mua kèm Deal Sốc
@endsection
@push('style')
@endpush
@section('content')

<div class="container-fluid">
    <div class="row mb-4">
        <a href="{{route('promotion.dealsock.add')}}" class="btn btn-success click_add"> + Tạo chương trình Deal Sốc mới</a>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tabDealSock" role="tablist">
            <a class="nav-item nav-link active" id="dealsock-cdr-tab" data-toggle="tab" href="#dealsock-cdr" role="tab" aria-controls="dealsock-cdr" aria-selected="false">Chưa diễn ra</a>
            <a class="nav-item nav-link " id="dealsock-dr-tab" data-toggle="tab" href="#dealsock-dr" role="tab" aria-controls="dealsock-dr" aria-selected="true">Đang diễn ra</a>
            <a class="nav-item nav-link" id="dealsock-kt-tab" data-toggle="tab" href="#dealsock-kt" role="tab" aria-controls="dealsock-kt" aria-selected="false">Đã kết thúc</a>
        </div>
    </nav>
    <div class="tab-content mt-4" id="nav-tabDealSockContent">
        <div class="tab-pane fade show active" id="dealsock-cdr" role="tabpanel" aria-labelledby="dealsock-cdr-tab">
            @if((count($dealsocknotstart)>0))
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped display nowrap hover" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="18%">Tên chương trình</th>
                                <th>Sản phẩm chính </th>
                                <th>Sản phẩm mua kèm </th>
                                <th>Bắt đầu</th>
                                <th>Kết thúc</th>
                                <th>Bắt đầu sau</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                foreach ($dealsocknotstart as $not) {
                                $mang_anh=$mang_anh2 = [];
                                foreach ($dataDealSockNotStart as $info) {
                                if($info->promotion_id==$not->id){
                                array_push($mang_anh, $info->product->product_image);
                                array_push($mang_anh2, $info->productCombo->product_image);
                                }
                                }
                                @endphp
                            <tr>
                                <td>
                                    <div class="">{{$not->promotion_name}}</div>
                                    <small class="text-warning">Chưa diễn ra</small>
                                </td>
                                <td> <img style="width:50px" src="{{$mang_anh[0]}}" alt=""></td>
                                <td>
                                    @php
                                    $i = 0;
                                    $dem = count($mang_anh2);
                                    foreach ($mang_anh2 as $anh) {
                                    if ($i < 3) { @endphp <img style="width:50px" src="{{$anh}}" alt="">
                                        @php
                                        $i++;
                                        } else { @endphp
                                        <span class="count-sp-con-lai text-primary " style="font-weight:600">+{{$dem - 3 }}</span>
                                        <i class="fas fa-ellipsis-h text-primary"></i>
                                        @php break;
                                        }
                                        }
                                        @endphp
                                </td>
                                <td>{{$not->promotion_datestart}}</td>
                                <td>{{$not->promotion_dateend}}</td>
                                <td>{!!diffDatePhp($not->promotion_dateend)!!}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{route('promotion.dealsock.show',['dealsock'=>$not->id])}}"><i class="fas fa-pencil-alt mr-2"></i>Sửa</a>
                                </td>
                                @php }@endphp
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="{{asset('nodata.png')}}" alt="">
                <p class="alert alert-danger p-1 fs-14">Chưa có chương trình giảm giá nào đang diễn ra</p>
            </div>
            @endif
        </div>
        <div class="tab-pane fade  " id="dealsock-dr" role="tabpanel" aria-labelledby="dealsock-dr-tab">
            @if((count($dealsock)>0))
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped display nowrap hover" id="dataTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="18%">Tên chương trình</th>
                                <th>Sản phẩm chính</th>
                                <th>Sản phẩm mua kèm</th>
                                <th>Bắt đầu</th>
                                <th>Kết thúc</th>
                                <th>Kết thúc sau</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                foreach ($dealsock as $run) {
                                $mang_anh=$mang_anh2 = [];
                                foreach ($dataDealSock as $info) {
                                if($info->promotion_id==$run->id){
                                array_push($mang_anh, $info->product->product_image);
                                array_push($mang_anh2, $info->productCombo->product_image);
                                }
                                }
                                @endphp
                            <tr>
                                <td>
                                    <div class="">{{$run->promotion_name}}</div>
                                    <small class="text-success">Đang diễn ra</small>
                                </td>
                                <td> <img style="width:50px" src="{{$mang_anh[0]}}" alt=""></td>
                                <td>
                                    @php
                                    $i = 0;
                                    $dem = count($mang_anh2);
                                    foreach ($mang_anh2 as $anh) {
                                    if ($i < 3) { @endphp <img style="width:50px" src="{{$anh}}" alt="">
                                        @php
                                        $i++;
                                        } else { @endphp
                                        <span class="count-sp-con-lai text-primary " style="font-weight:600">+{{$dem - 3 }}</span>
                                        <i class="fas fa-ellipsis-h text-primary"></i>
                                        @php break;
                                        }
                                        }
                                        @endphp
                                </td>
                                <td>{{$run->promotion_datestart}}</td>
                                <td>{{$run->promotion_dateend}}</td>
                                <td>{!!diffDatePhp($run->promotion_dateend)!!}</td>
                                <td>
                                    <a class="btn btn-danger btn-action-end btn-sm" data-url="{{route('promotion.dealsock.end',['id'=>$run->id])}}"><i class="fa fa-hourglass-end mr-2" aria-hidden="true"></i>Kết thúc </a>
                                    <a class="btn btn-info btn-sm" href="{{route('promotion.dealsock.show',['dealsock'=>$run->id])}}"><i class="fas fa-pencil-alt mr-2"></i>Sửa</a>
                                </td>
                                @php }@endphp
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="{{asset('nodata.png')}}" alt="">
                <p class="alert alert-danger p-1 fs-14">Chưa có chương trình giảm giá nào đang diễn ra</p>
            </div>
            @endif
        </div>
        <div class="tab-pane fade" id="dealsock-kt" role="tabpanel" aria-labelledby="dealsock-kt-tab">
            @if((count($dealsockend)>0))
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped display nowrap hover" id="" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="18%">Tên chương trình</th>
                                <th>Sản phẩm chính</th>
                                <th>Sản phẩm mua kèm</th>
                                <th>Bắt đầu</th>
                                <th>Kết thúc</th>
                                <th>Kết thúc được</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                foreach ($dealsockend as $end) {
                                $mang_anh=$mang_anh2 = [];
                                foreach ($dataDealSockEnd as $info) {
                                if($info->promotion_id==$end->id){
                                array_push($mang_anh, $info->product->product_image);
                                array_push($mang_anh2, $info->productCombo->product_image);
                                }
                                }
                                @endphp
                            <tr>
                                <td>
                                    <div class="">{{$end->promotion_name}}</div>
                                    <small class="text-danger">Đã kết thúc</small>
                                </td>
                                <td> <img style="width:50px" src="{{$mang_anh[0]}}" alt=""></td>
                                <td>
                                    @php
                                    $i = 0;
                                    $dem = count($mang_anh2);
                                    foreach ($mang_anh2 as $anh) {
                                    if ($i < 3) { @endphp <img style="width:50px" src="{{$anh}}" alt="">
                                        @php
                                        $i++;
                                        } else { @endphp
                                        <span class="count-sp-con-lai text-primary " style="font-weight:600">+{{$dem - 3 }}</span>
                                        <i class="fas fa-ellipsis-h text-primary"></i>
                                        @php break;
                                        }
                                        }
                                        @endphp
                                </td>
                                <td>{{$end->promotion_datestart}}</td>
                                <td>{{$end->promotion_dateend}}</td>
                                <td>{!!diffDatePhp($end->promotion_dateend)!!}</td>
                                <td> <a class="btn btn-danger btn-sm  btn-action-delete" data-url="{{route('promotion.dealsock.delete',['id'=>$end->id])}}"><i class="fas fa-trash mr-2"></i>Xóa </a></td>
                                @php }@endphp
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="{{asset('nodata.png')}}" alt="">
                <p class="alert alert-danger p-1 fs-14">Chưa có chương trình giảm giá nào đang diễn ra</p>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
@push('scripts')
@endpush
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/components/confirmDel.js')}}"></script>
<script type="module" src="{{Vite::asset('resources/js/components/confirmEnd.js')}}"></script>
@endprepend
