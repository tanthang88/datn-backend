@extends('layout/masterLayout')
@section('title')
Danh sách nhân viên
@endsection
@push('style')
@endpush
@section('content')

<div class="container-fluid">
    <div class="row" style="padding-top:15px;padding-bottom:15px;">
        <div class="col-2">
            <button type="button" class="btn btn-success"><a href="{{route('staff.add')}}" style="color:#fff">+ Thêm mới</a></button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table
                class="table table-striped display nowrap hover"
                id="dataTable"
                style="width: 100%"
            >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên nhân viên</th>
                        <th>Email</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Điện thoại</th>
                        <th>Vai trò</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@prepend('scripts')
<script
    type="module"
    src="{{Vite::asset('resources/js/staff/list.js')}}"
></script>
<script
    type="module"
    src="{{Vite::asset('resources/js/components/confirmDel.js')}}"
></script>
@endprepend
