@extends('layout/masterLayout') @section('title') Danh sách khách hàng
@endsection @push('style') @endpush @section('content')

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">Danh sách khách hàng</div>
    </div>
    <!-- Main row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table
                class="table table-striped display nowrap hover"
                id="tableUser"
                style="width: 100%"
            >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('pages.user.delete') @endsection @prepend('scripts')
<script
    type="module"
    src="{{Vite::asset('resources/js/user/list.js')}}"
></script>
@endprepend
