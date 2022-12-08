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
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Vui lòng điền thông tin chi tiết về chương trình giảm giá của bạn </h3>
                </div>
                <form method="POST" action="{{route('promotion.dealsock.update', ['dealsock' => $dealsock])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dealsock_name">Tên chương trình giảm giá</label>
                                    <input type="text" data-id_promotion="{{$dealsock->id}}" class="form-control @error('dealsock_name') is-invalid @enderror" id="dealsock_name" name="dealsock_name" placeholder="Nhập tên chương trình" value="{{ $dealsock->promotion_name }}">
                                    @error('dealsock_name')
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
                                        <input type="text" class="form-control float-right @error('dealsock_daterange') is-invalid @enderror reservationtime" id="dealsock_daterange" name="dealsock_daterange" value="{{$dealsock->promotion_datestart }} - {{ $dealsock->promotion_dateend}}">
                                    </div>
                                    <small class="text-secondary "> * Thời gian kết thúc phải sau thời gian bắt đầu ít nhất 1 giờ</small>
                                    @error('dealsock_daterange')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dealsock_type">Loại chương trình giảm giá</label>
                                    <select class="form-control loaigiamgiatien" name="dealsock_type" id="dealsock_type">
                                        <option value="0" @if($dealsock->promotion_type==0) selected @endif> Giảm giá theo % </option>
                                        <option value="1" @if($dealsock->promotion_type==1) selected @endif> Giảm giá theo số tiền </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dealsock_numberofuse">Giới hạn đặt hàng</label>
                                    <input type="text" class="form-control @error('dealsock_numberofuse') is-invalid @enderror" id="dealsock_numberofuse" name="dealsock_numberofuse" placeholder="Nhập số giới hạn đặt hàng" value="{{ $dealsock->promotion_numer_of_use}}">
                                    <small class="text-secondary ">* Khi số lượng đặt hàng vượt mức sẻ tự động tạm dừng chương trình khuyến mãi này</small>
                                    @error('dealsock_numberofuse')
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
                                        <a href="{{route('promotion.dealsock.list')}}" class="btn btn-warning mr-2"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a>
                                        <button type="submit" class="btn btn-success click_update "><i class="fas fa-check "></i> Hoàn tất</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row g-3 align-items-center box-form-giam-gia add-them-san-pham">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="" class="col-form-label pr-4">Sản phẩm chính</label>
                                        </div>
                                        <div class="col-3">
                                            <div class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-dealsockProduct"><i class="fas fa-plus"></i> Thay đổi</div>
                                        </div>
                                    </div>
                                    <div class="my-2 box-form-giam-gia">
                                        <table id="dataTableLoadSpSession" class="table table-striped table-bordered" style="width:100% !important;">
                                            <thead>
                                                <th>ID</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Giá gốc</th>
                                                <th>Mức giảm</th>
                                                <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 my-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="" class="col-form-label pr-4">Sản phẩm mua kèm</label>
                                        </div>
                                        <div class="col-3">
                                            <div class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-dealsockProductCombo"><i class="fas fa-plus"></i> Thay đổi</div>
                                        </div>
                                    </div>
                                    <div class="my-2 box-form-giam-gia">
                                        <table id="dataTableLoadSpSessionCombo" class="table table-striped table-bordered" style="width:100% !important;">
                                            <thead>
                                                <th>ID</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Giá gốc</th>
                                                <th>Mức giảm</th>
                                                <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>
    <div class="modal fade " id="modal-dealsockProduct" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <div>
                        <h4 class="modal-title">Chọn sản phẩm chính</h4>
                        <p class="text-info mb-0">Một sản phẩm chỉ có thể tham gia một lần vào chương trình khuyến mãi</p>
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
                                    <th scope="col"><input name="checkall_id_sp" id="checkall_id_sp" type="radio" disabled></th>
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
    <div class="modal fade " id="modal-dealsockProductCombo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <div>
                        <h4 class="modal-title">Chọn sản phẩm mua kèm</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body px-2 pt-0 pb-2">
                    <div class="table-sp my-4  table-responsive">
                        <table class=" align-middle table table-hover display nowrap hover" style="width:100% !important;" id="dataTableProductAllCombo">
                            <thead>
                                <tr>
                                    <th scope="col"><input name="checkall_id_sp_combo" id="checkall_id_sp_combo" type="checkbox"></th>
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
                    <button type="button" id="submitAddProductSessionCombo" class="btn btn-info">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
   $('#checkall_id_sp_combo').click(function(event) {
        if (this.checked) {
            $(':checkbox.check_id_sp_combo:not(:disabled)').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox.check_id_sp_combo:not(:disabled)').each(function() {
                this.checked = false;
            });
        }
    });
</script>
@endpush
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/dealsock/edit.js')}}"></script>
@endprepend
