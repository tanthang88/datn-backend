@extends('layout/masterLayout')
@section('title')
Cập nhật chương trình mã giảm giá
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
                    <h3 class="card-title">Vui lòng điền thông tin chi tiết về chương trình mã giảm giá của bạn </h3>
                </div>
                <form method="POST" action="{{route('promotion.discount-code.update', ['discountcode' => $discountcode])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discoutcode_name">Tên chương trình mã giảm giá</label>
                                    <input type="text" class="form-control @error('discoutcode_name') is-invalid @enderror" id="discoutcode_name" name="discoutcode_name" placeholder="Nhập tên chương trình" value="{{ $discountcode->promotion_name }}">
                                    @error('discoutcode_name')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mã giảm giá</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">LF</span>
                                        </div>
                                        <input type="text" class="form-control  @error('discoutcode_code') is-invalid @enderror" id="discoutcode_code" name="discoutcode_code" value="{{ $promotion_product->promotion_code }}" placeholder="Nhập mã" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    @error('discoutcode_code')
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
                                        <input type="text" class="form-control float-right @error('discoutcode_daterange') is-invalid @enderror reservationtime" id="discoutcode_daterange" name="discoutcode_daterange" value="{{$discountcode->promotion_datestart }} - {{ $discountcode->promotion_dateend}}">
                                    </div>
                                    <small class="text-secondary "> * Thời gian kết thúc phải sau thời gian bắt đầu ít nhất 1 giờ</small>
                                    @error('discoutcode_daterange')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discountcode_type">Loại chương trình giảm giá</label>
                                    <select class="form-control loaigiamgiatien" name="discountcode_type" id="discountcode_type">
                                        <option value="0" @if($discountcode->promotion_type==0) selected @endif> Giảm giá theo % </option>
                                        <option value="1" @if($discountcode->promotion_type==1) selected @endif> Giảm giá theo số tiền </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discoutcode_ordervalue"> Giá trị đơn hàng tối thiểu</label>
                                    <input type="number" hidden class="tientehidden"  name="discoutcode_ordervalue" id="discoutcode_ordervalue" value="{{ $promotion_product->promotion_order_value }}">
                                    <input type="text" class="tiente form-control @error('discoutcode_ordervalue') is-invalid @enderror" value="{{ $promotion_product->promotion_order_value }}"  placeholder="Nhập giá trị đơn hàng tối thiểu" value="{{ old('discoutcode_ordervalue') }}">
                                    @error('discoutcode_ordervalue')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discoutcode_rate">Mức giảm</label>
                                    <input type="number" hidden class="tientehidden" id="discoutcode_rate" name="discoutcode_rate" value="{{ $promotion_product->promotion_rate }}">
                                    <input type="text" class="tiente mucgiam form-control @error('discoutcode_rate') is-invalid @enderror"   placeholder="% or VND" value="{{ $promotion_product->promotion_rate }}">
                                    @error('discoutcode_rate')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discoutcode_numberofuse">Giới hạn sử dụng mã</label>
                                    <input type="text" class="form-control @error('discoutcode_numberofuse') is-invalid @enderror" id="discoutcode_numberofuse" name="discoutcode_numberofuse" placeholder="Nhập số lượng mã" value="{{ $discountcode->promotion_numer_of_use }}">
                                    <small class="text-secondary ">* Khi số lượng đặt hàng vượt mức sẻ tự động tạm dừng chương trình khuyến mãi này</small>
                                    @error('discoutcode_numberofuse')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@prepend('scripts')
<script>

</script>
@endprepend
