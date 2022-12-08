@extends('layout/masterLayout')
@section('title')
Chỉnh sửa nhân viên
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
                    <h3 class="card-title">Thông tin nhân viên</h3>
                </div>
                <form method="POST" action="{{ route('staff.update', ['staff' => $staff]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        disabled id="email" name="email" placeholder="Nhập Email"
                                        value="{{ $staff->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $staff->name }}" placeholder="Nhập Họ và tên">
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
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a onclick="handleShowPassword(this)" class="btn btn-default"
                                                id="isChange">Thay đổi</a>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" hidden
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" value="" placeholder="Nhập mật khẩu">
                                        </div>
                                        <div class="col-md-2">
                                            <a id="isCancel" onclick="handleHidePassword(this)" hidden
                                                class="btn btn-danger">Huỷ</a>
                                        </div>
                                        <input type="hidden" id="is_change_password" name="is_change_password"
                                            value="0">
                                    </div>

                                    @error('password')
                                    <span style="color: red;font-style: italic"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel">Điện thoại</label>
                                    <input type="number" class="form-control @error('tel') is-invalid @enderror"
                                        id="tel" name="tel" value="{{ $staff->tel }}"
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
                                        id="birthday" name="birthday" value="{{ $staff->birthday }}"
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
                                        <option @if($staff->AdminRolesUser->contains('id', $role->id)) selected @endif
                                            value="{{$role->id}}">
                                            {{$role->display_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Giới tính</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="0"
                                            @if($staff->gender == 0) checked @endif />
                                        <label class="form-check-label">Nam</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="1"
                                            @if($staff->gender == 1) checked @endif />
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
<script type="text/javascript">
    function handleShowPassword(e) {
        $('#password').attr("hidden", false)
        $('#isChange').parent().attr("hidden", true)
        $('#isCancel').attr("hidden", false)
        $('#is_change_password').val('1')
    }
    function handleHidePassword(e) {
        $('#password').attr("hidden", true)
        $('#isChange').parent().attr("hidden", false)
        $('#isCancel').attr("hidden", true)
        $('#is_change_password').val('0')
    }
</script>
@endprepend
