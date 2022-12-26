@extends('layout/masterLayout')
@section('title')
Cập nhật chương trình giảm giá sản phẩm
@endsection
@push('style')
@endpush
@section('content')
<div class="container-fluid">
    <x-alert errorText="{{ trans('alert.update.error') }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Vui lòng điền thông tin chi tiết về chương trình giảm giá của bạn </h3>
                </div>
                <form method="POST" action="{{route('promotion.discount.update', ['discount' => $discount])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="discout_name">Tên chương trình giảm giá</label>
                                    <input type="text" data-id_promotion="{{$discount->id}}" class="form-control @error('discout_name') is-invalid @enderror" id="discout_name" name="discout_name" placeholder="Nhập tên chương trình" value="{{ $discount->promotion_name }}">
                                    @error('discout_name')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Thời gian diễn ra</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right @error('discout_daterange') is-invalid @enderror reservationtime" id="discout_daterange" name="discout_daterange" value="{{$discount->promotion_datestart }} - {{ $discount->promotion_dateend}}">
                                    </div>
                                    <small class="text-secondary "> * Thời gian kết thúc phải sau thời gian bắt đầu ít nhất 1 giờ</small>
                                    @error('discout_daterange')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_type">Loại chương trình giảm giá</label>
                                    <select class="form-control loaigiamgiatien" name="discount_type" id="discount_type">
                                        <option value="0" @if($discount->promotion_type==0) selected @endif> Giảm giá theo % </option>
                                        <option value="1" @if($discount->promotion_type==1) selected @endif> Giảm giá theo số tiền </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discout_rate">Mức giảm</label>
                                    <input type="number" hidden class="tientehidden" id="discout_rate" name="discout_rate" value="{{$promotion_product->promotion_rate }}">
                                    <input type="text" class="tiente mucgiam form-control @error('discout_rate') is-invalid @enderror" placeholder="% or VND" value="{{$promotion_product->promotion_rate }}">
                                    @error('discout_rate')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discout_numberofuse">Giới hạn đặt hàng</label>
                                    <input type="text" class="form-control @error('discout_numberofuse') is-invalid @enderror" id="discout_numberofuse" name="discout_numberofuse" placeholder="Nhập số giới hạn đặt hàng" value="{{ $discount->promotion_numer_of_use}}">
                                    <small class="text-secondary ">* Khi số lượng đặt hàng vượt mức sẻ tự động tạm dừng chương trình khuyến mãi này</small>
                                    @error('discout_numberofuse')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row g-3 align-items-center box-form-giam-gia add-them-san-pham">
                                    <div class="col-6">
                                        <label for="" class="col-form-label pr-4">Sản phẩm</label>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="{{route('promotion.discount.list')}}" class="btn btn-warning mr-2"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a>
                                        <div class="btn btn-outline-dark mr-2" data-toggle="modal" data-target="#modal-discountProduct"><i class="fas fa-plus"></i> Thêm sản phẩm</div>
                                        <button type="submit" class="btn btn-success click_update "><i class="fas fa-check "></i> Hoàn tất</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                        if (Session::get('dataSessionProductDiscount') != null || isset($discount)) { @endphp
                        <div class="my-2 box-form-giam-gia">
                            <table id="dataTableLoadSpSession" class="table table-striped table-bordered" style="width:100% !important;">
                                <thead>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá gốc</th>
                                    <th>Giá sau giảm</th>
                                    <th>Thao tác</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        @php } else {@endphp
                        <div class="my-2 justify-content-center box-form-giam-gia remove-khi-co-sp">
                            <div class="box-chua-co-san-pham text-center mx-auto">
                                <img src="{{asset('nodata.png')}}" alt="">
                                <div class="text-center my-3">
                                    <div class="btn btn-info" data-toggle="modal" data-target="#modal-discountProduct"><i class="fas fa-plus"></i> Thêm sản phẩm</div>
                                </div>
                            </div>
                        </div>
                        @php }@endphp
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>
    <div class="modal fade " id="modal-discountProduct" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <div>
                        <h4 class="modal-title">Chọn sản phẩm</h4>
                        <p class="text-primary mb-0">Một sản phẩm chỉ có thể tham gia một lần vào chương trình khuyến mãi</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body px-2 pt-0 pb-2">
                    <div class="table-sp my-4  table-responsive">
                        <table class=" align-middle table table-hover display nowrap hover" style="width:100% !important;" id="dataTableProductAll">
                            <thead>
                                <tr>
                                    <th scope="col"><input name="checkall_id_sp" id="checkall_id_sp" type="checkbox"></th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Kho</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" id="submitAddProductSession" class="btn btn-info">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#checkall_id_sp').click(function(event) {
        if (this.checked) {
            $(':checkbox.check_id_sp:not(:disabled)').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox.check_id_sp:not(:disabled)').each(function() {
                this.checked = false;
            });
        }
    });
</script>
@endpush
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/discount/edit.js')}}"></script>
@endprepend
