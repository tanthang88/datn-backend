@extends('layout/masterLayout')
@section('title')
Danh sách bình luận
@endsection
@push('style')
<style>
   img.table-avatar {
        display: inline;
        width: 2.5rem;
    }
</style>
@endpush
@section('content')
<!-- Content Header (Page header) -->
<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 table-responsive">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Danh sách bình luận</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped display nowrap hover" id="dataTableContact" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sản phẩm</th>
                                <th>Tên khách hàng </th>
                                <th>Điện thoại </th>
                                <th>Nội dung </th>
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
<script type="module" src="{{Vite::asset('resources/js/comment/list.js')}}"></script>
<script type="module" src="{{Vite::asset('resources/js/components/confirmDel.js')}}"></script>
@endprepend
