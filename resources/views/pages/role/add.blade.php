@extends('layout/masterLayout') @section('title') Thêm Phân Quyền @endsection
@push('styles')
<style></style>
@endpush @section('content')
<div class="container-fluid">
    <form
        method="POST"
        action="{{ route('role.store') }}"
        enctype="multipart/form-data"
    >
        @csrf
        <x-alert errorText="{{ trans('alert.add.error') }}" />
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông Tin Phân Quyền</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="catName">Tên Phân Quyền</label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}"
                                        placeholder="Nhập Tên Phân Quyền"
                                    />
                                    @error('name')
                                    <span
                                        style="color: red; font-style: italic"
                                    >
                                        {{ $message }}</span
                                    >
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="catName">Mô Tả</label>
                                        <input
                                            type="text"
                                            name="display_name"
                                            class="form-control @error('display_name') is-invalid @enderror"
                                            value="{{ old('display_name') }}"
                                            placeholder="Mô Tả Phân Quyền"
                                        />
                                        @error('display_name')
                                        <span
                                            style="
                                                color: red;
                                                font-style: italic;
                                            "
                                        >
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý phân quyền</h3>
                    </div>
                    <div class="card-body">
                        @error('permission_id')
                        <div style="color: red; font-style: italic">
                            {{ $message }}
                        </div>
                        @enderror
                        <label for="_checkAll">
                            <input
                                type="checkbox"
                                id="_checkAll"
                                class="checkboxAllPermission"
                            />
                            Chọn Tất Cả Các Quyền
                        </label>
                        @foreach ($permissions as $key => $permission)
                        <div
                            class="form-group py-2 px-3 border border-light bg-light rounded"
                        >
                            <label for="_checkGroup{{ $key }}">
                                <input
                                    type="checkbox"
                                    id="_checkGroup{{ $key }}"
                                    class="checkGroupPermission"
                                />
                                {{$permission->display_name}}
                            </label>

                            <div class="row">
                                @foreach($permission->getPermissionChild as 
                                $keyChild => $perChild)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input checkbox_children"
                                            type="checkbox"
                                            id="_checkChild{{ $key.$keyChild }}"
                                            name="permission_id[]"
                                            value="{{$perChild->id}}"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="_checkChild{{
                                                $key.$keyChild
                                            }}"
                                            >{{$perChild->display_name}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">
                            Thêm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection @prepend('scripts')
<script
    type="module"
    src="{{Vite::asset('resources/js/role/add.js')}}"
></script>
@endprepend
