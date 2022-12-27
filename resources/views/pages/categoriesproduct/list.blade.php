@extends('layout/masterLayout')
@section('title')
{{$title}}
@endsection
@push('style')
<style>
    th {
        font-size: 14px;
    }
</style>
@endpush
@section('content')
<!-- Main content -->
<div class="container-fluid">
    <div class="row" style="padding-top:15px;padding-bottom:15px;">
        <div class="col-2">
            <button type="button" class="btn btn-success"><a href="{{route('categoryProduct.add')}}" style="color:#fff">+ Thêm mới</a></button>
        </div>
        <div class="col-7"></div>
        <form action="" class="col-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">
                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên danh mục</th>
                        <th>Hiển thị</th>
                        <th style="text-align:center;">Nổi bật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    {!! \App\Helper\Category_Product_Helper::category($product_categories) !!}
                </tbody>
            </table>
            <hr />
                {{ $product_categories->links() }}
        </div>
    </div>
</div>

</div>
@endsection
@push('scripts')
<script
type="module"
src="{{Vite::asset('resources/js/components/confirmDel.js')}}"
></script>
@endpush
