@extends('layout/masterLayout') @section('title') Thêm Phân Quyền @endsection
@push('styles')
<style></style>
@endpush @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm Phân Quyền</h3>
                </div>
                <form
                    method="POST"
                    action="{{ route('permissions.store') }}"
                    enctype="multipart/form-data"
                >
                    @csrf
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
                                            {{ $message }}</span
                                        >
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button
                            type="submit"
                            class="btn btn-primary float-right"
                        >
                            Thêm
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Quản lý phân quyền</h3>
                </div>
                <div class="card-body">


                    <div
                        class="form-group py-2 px-3 border border-light bg-secondary rounded"
                    >
                        <label for="exampleInputEmail1">Email address</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                    />
                                    <label class="form-check-label"
                                        >Danh sách
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                    />
                                    <label class="form-check-label"
                                        >Thêm
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                    />
                                    <label class="form-check-label">Sửa </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                    />
                                    <label class="form-check-label">Xoá </label>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @prepend('scripts')
<script></script>
@endprepend
