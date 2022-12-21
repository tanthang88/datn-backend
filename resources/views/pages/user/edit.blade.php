@extends('layout/masterLayout')
@section('title')
Chỉnh sửa khách hàng
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <x-alert errorText="{{ trans('alert.update.error') }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin khách hàng</h3>
                    @if ($user->status)
                    <span class="label label-success float-lg-right rounded px-2 text-dark bg-white">
                        Hoạt động <i class="fas fa-check text-success"></i>
                    </span>
                    @endif
                </div>
                <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        disabled id="email" name="email" placeholder="Nhập Email"
                                        value="{{ $user->email }}">
                                    @error('email')
                                    <span style="color: red;font-style: italic"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $user->name }}" placeholder="Nhập Họ và tên">
                                    @error('name')
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
                                        id="birthday" name="birthday" value="{{ $user->birthday }}"
                                        placeholder="Nhập ngày tháng">
                                    @error('birthday')
                                    <span style="color: red;font-style: italic"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel">Điện thoại</label>
                                    <input type="number" class="form-control @error('tel') is-invalid @enderror"
                                        id="tel" name="tel" value="{{ $user->tel }}"
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
                                    <label for="name">Giới tính</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="0" name="gender"
                                                @checked( $user->gender === 0 ?? false )
                                            >
                                        <label class="form-check-label">Nam</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="0" name="gender"
                                            @checked( $user->gender === 1 ?? false )
                                        >
                                        <label class="form-check-label">Nữ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img class="w-100 " id="showAvatar"
                                                src="{{ $user->avatar ? asset($user->avatar) : asset('/default-avatar.png') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="inputFile">Tải lên ảnh</label>
                                            <input type="file" name="avatar" id="avatarFile"
                                                accept="image/gif, image/jpeg, image/png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" class="form-control  @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ $user->address }}"
                                        placeholder="Nhập số địa chỉ">
                                    @error('address')
                                    <span style="color: red;font-style: italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thành phố</label>
                                    <select class="form-control" name="city_id" id="city">
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" @selected($user->city_id === $city->id)>
                                            {{ $city->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quận huyện</label>
                                    <select class="form-control" name="dist_id" data-repeat="dist" id="myDist">
                                        @foreach ($dists as $dist)
                                        <option value="{{ $dist->id }}" @selected($user->dist_id === $dist->id)>
                                            {{ $dist->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status"
                            @if(!$user->status) checked @endif>
                            <label class="form-check-label" for="status">Khoá tài khoản</label>
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
<script type="module" src="{{Vite::asset('resources/js/user/edit.js')}}"></script>
@endprepend
