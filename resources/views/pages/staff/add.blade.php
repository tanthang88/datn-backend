@extends('layout/masterLayout')
@section('title')
Thêm nhân viên
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
                    <h3 class="card-title">Thêm nhân viên</h3>
                </div>
                <form method="POST" action="{{route('staff.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Nhập Email" value="{{ old('email') }}">
                                    @error('email')
                                    <span style="color: red;font-style: italic"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên">
                                    @error('name')
                                    <span style="color: red;font-style: italic"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Mật khẩu</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" value="{{ old('password') }}" placeholder="Nhập mật khẩu">
                                    @error('password')
                                    <span style="color: red;font-style: italic"> {{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel">Điện thoại</label>
                                    <input type="number" class="form-control @error('tel') is-invalid @enderror"
                                        id="tel" name="tel" value="{{ old('tel') }}"
                                        placeholder="Nhập số điện thoại liên hệ">
                                    @error('tel')
                                    <span style="color: red;font-style: italic"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="birthday">Ngày sinh</label>
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                        id="birthday" name="birthday" value="{{ old('birthday') }}"
                                        placeholder="Nhập ngày tháng">
                                    @error('birthday')
                                    <span style="color: red;font-style: italic"> {{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Vai trò</label>
                                    <select class="form-control" name="role[]" id="city">
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">
                                            {{$role->display_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Giới tính</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="0" name="gender"
                                            @if(old('gender')) checked @endif>
                                        <label class="form-check-label">Nam</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="1" name="gender"
                                            @if(!old('gender')) checked @endif>
                                        <label class="form-check-label">Nữ</label>
                                    </div>
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
@endprepend
