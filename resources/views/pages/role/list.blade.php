@extends('layout/masterLayout')
@section('title')
Danh sách phân quyền
@endsection
@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row" style="padding-top:15px;padding-bottom:15px;">
        <div class="col-2">
            <button type="button" class="btn btn-success"><a href="{{route('role.add')}}" style="color:#fff">+ Thêm mới</a></button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped display nowrap hover" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên vai trò</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/role/list.js')}}"></script>
<script type="module" src="{{Vite::asset('resources/js/components/confirmDel.js')}}"></script>
@endprepend
