@extends('layout/masterLayout')
@section('title')
Tạo phí ship
@endsection
@push('style')
@endpush
@section('content')
<div class="container-fluid">
    <x-alert errorText="{{ trans('alert.add.error') }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Vui lòng điền thông tin phí ship cho các khu vực </h3>
                </div>
                <form method="POST" action="{{route('feeship.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about_name">Tên khu vực</label>
                                    <input type="text" class="form-control @error('about_name') is-invalid @enderror" id="about_name" name="about_name" placeholder="Nhập tên khu vực" value="{{ old('about_name') }}">
                                    @error('about_name')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="transport_fee">Giá ship</label>
                                    <input type="number" hidden class="tientehidden" id="transport_fee" name="transport_fee"  value="{{  old('transport_fee',null)===null?0:old('transport_fee')}}">
                                    <input type="text" class="tiente mucgiam form-control @error('transport_fee') is-invalid @enderror" placeholder="0 VND" value="{{  old('transport_fee',null)===null?0:old('transport_fee')}}">
                                    <small class="text-primary" style="font-style: italic"><i class="fa fa-question-circle" aria-hidden="true"></i> Có thể để trống giá ship nếu muốn <b>Free Ship</b></small>
                                    @error('transport_fee')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Địa điểm</label>
                                    <select  class="select2" multiple="multiple" id="id_city" name="id_city[]" data-placeholder="Tất cả địa điểm" style="width: 100%;">
                                        @foreach($city as $k=> $ct)
                                        <option value="{{$ct->code}}" >{{$ct->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
    $('.select2').select2({
        theme: "bootstrap4",
    })
</script>
@endprepend
