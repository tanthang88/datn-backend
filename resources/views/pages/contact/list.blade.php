@extends('layout/masterLayout')
@section('title')
Danh sách liên hệ
@endsection
@push('styles')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 table-responsive">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Danh sách liên hệ</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped display nowrap hover" id="dataTableContact" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu đề</th>
                                <th>Họ tên </th>
                                <th>Email </th>
                                <th>Điện thoại </th>
                                <th>Ngày gửi </th>
                                <th>Trạng thái </th>
                                <th>Thao tác</th>
                            </tr>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <hr />
    </div>
</div>
</div>
@endsection
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/contact/list.js')}}"></script>
<script type="module" src="{{Vite::asset('resources/js/components/confirmDel.js')}}"></script>
@endprepend
