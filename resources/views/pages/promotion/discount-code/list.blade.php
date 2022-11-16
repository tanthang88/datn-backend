@extends('layout/masterLayout')
@section('title')
Chương trình tạo mã giảm giá
@endsection
@push('style')
<style>
    .img-ma_giam_gia {
        background-color: #48dbfb;
        width: 45px;
        height: 45px;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .img-ma_giam_gia i {
    font-size: 24px;
    color: #fff;
}
</style>
@endpush
@section('content')

<div class="container-fluid">
    <div class="row mb-4">
        <a href="{{route('promotion.discount-code.add')}}" class="btn btn-success"> + Tạo chương trình mã giảm giá mới</a>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tabDiscountCode" role="tablist">
            <a class="nav-item nav-link active" id="discount-code-cdr-tab" data-toggle="tab" href="#discount-code-cdr" role="tab" aria-controls="discount-code-cdr" aria-selected="false">Chưa diễn ra</a>
            <a class="nav-item nav-link " id="discount-code-dr-tab" data-toggle="tab" href="#discount-code-dr" role="tab" aria-controls="discount-code-dr" aria-selected="true">Đang diễn ra</a>
            <a class="nav-item nav-link" id="discount-code-kt-tab" data-toggle="tab" href="#discount-code-kt" role="tab" aria-controls="discount-code-kt" aria-selected="false">Đã kết thúc</a>
        </div>
    </nav>
    <div class="tab-content mt-4" id="nav-tabDiscountCodeContent">
        <div class="tab-pane fade show active" id="discount-code-cdr" role="tabpanel" aria-labelledby="discount-code-cdr-tab">
            @if((count($discountcodenotstart)>0))
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped display nowrap hover" id="dataTable0" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th >Mã giảm giá </thc>
                                <th >Tên chương trình</th>
                                <!-- <th >Số mã có thể sử dụng</th> -->
                                <!-- <th>Đã dùng</th> -->
                                <th>Trạng thái </th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Bắt đầu sau</th>
                                <th>Sửa</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @else
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="{{asset('nodata.png')}}" alt="">
                <p class="alert alert-danger p-1 fs-14">Chưa có chương trình mã giảm giá nào đang diễn ra</p>
            </div>
            @endif
        </div>
        <div class="tab-pane fade  " id="discount-code-dr" role="tabpanel" aria-labelledby="discount-code-dr-tab">
            @if((count($discountcode)>0))
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped display nowrap hover" id="dataTable" style="width: 100%">
                        <thead>
                            <tr>
                            <th></th>
                                <th></th>
                                <th >Mã giảm giá </thc>
                                <th >Tên chương trình</th>
                                <!-- <th >Số mã có thể sử dụng</th> -->
                                <!-- <th>Đã dùng</th> -->
                                <th>Trạng thái </th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Kết thúc sau</th>
                                <th>Kết thúc</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @else
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="{{asset('nodata.png')}}" alt="">
                <p class="alert alert-danger p-1 fs-14">Chưa có chương trình mã giảm giá nào đang diễn ra</p>
            </div>
            @endif
        </div>
        <div class="tab-pane fade" id="discount-code-kt" role="tabpanel" aria-labelledby="discount-code-kt-tab">
            @if((count($discountcodeend)>0))
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped display nowrap hover" id="dataTable2" style="width: 100%">
                        <thead>
                            <tr>
                            <th></th>
                                <th></th>
                                <th >Mã giảm giá </thc>
                                <th >Tên chương trình</th>
                                <!-- <th >Số mã có thể sử dụng</th> -->
                                <!-- <th>Đã dùng</th> -->
                                <th>Trạng thái </th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Kết thúc được</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @else
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="{{asset('nodata.png')}}" alt="">
                <p class="alert alert-danger p-1 fs-14">Chưa có chương trình mã giảm giá nào đang diễn ra</p>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
@push('scripts')
@endpush
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/discountcode/list.js')}}"></script>
<script type="module" src="{{Vite::asset('resources/js/components/confirmDel.js')}}"></script>
<script type="module" src="{{Vite::asset('resources/js/components/confirmEnd.js')}}"></script>
@endprepend
