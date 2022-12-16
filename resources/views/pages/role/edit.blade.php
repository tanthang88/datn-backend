@extends('layout/masterLayout') @section('title') Sửa Phân Quyền @endsection
@push('styles')
<style></style>
@endpush @section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('role.update',['role'=>$role]) }}" enctype="multipart/form-data">
        @csrf
        <x-alert errorText="{{ trans('alert.update.error') }}" />
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
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{$role->name}}"
                                        placeholder="Nhập Tên Phân Quyền" />
                                    @error('name')
                                    <span style="color: red; font-style: italic">
                                        {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="catName">Mô Tả</label>
                                        <input type="text" name="display_name"
                                            class="form-control @error('display_name') is-invalid @enderror"
                                            value="{{ $role->display_name }}" placeholder="Mô Tả Phân Quyền" />
                                        @error('display_name')
                                        <span style="
                                                color: red;
                                                font-style: italic;
                                            ">
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
                            <input type="checkbox" id="_checkAll" class="checkboxAllPermission" />
                            Chọn Tất Cả Các Quyền
                        </label>
                        @foreach ($permissions as $key => $permission)
                        <div class="form-group py-2 px-3 border border-light bg-light rounded">
                            <label for="_checkGroup{{ $key }}">
                                <input type="checkbox" id="_checkGroup{{ $key }}" name="permission_id[]"
                                    class="checkGroupPermission" value="{{ $permission->id }}"
                                    @if($rolePerOld->contains('id',$permission->id))
                                checked
                                @endif
                                />
                                {{$permission->display_name}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">
                            Cập nhật
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection @prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/role/add.js')}}"></script>
@endprepend