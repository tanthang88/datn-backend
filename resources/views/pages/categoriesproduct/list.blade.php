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
                        <th>Loại danh mục</th>
                        <th>Hiển thị</th>
                        <th style="text-align:center;">Nổi bật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @foreach($product_categories as $product_category)
                <tbody>
                    <tr>
                        <td>{{$product_category->id}}</td>
                        <td>
                            @if ($product_category->category_image!=null)
                                <img style="width:80px;height:80px;object-fit: cover;" src="{{$product_category->category_image}}">
                            @else
                                Trống
                            @endif
                        </td>
                        <td>{{$product_category->category_name}}</td>
                        <td>
                            @if($product_category->parent_id == 0)
                                Danh mục cha
                            @else
                                Danh mục con
                            @endif
                        </td>
                        <td class="check">
                            @if($product_category->category_display ==1)
                                <span class="badge badge-success">Hiển thị</span>
                            @else
                                <span class="badge badge-danger">Ẩn</span>
                            @endif
                        </td>
                        <td style="text-align:center;">
                           @if($product_category->category_outstanding ==1)
                                <i class="fa fa-star" aria-hidden="true"></i>
                           @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{route('categoryProduct.update',['id'=>$product_category->id])}}">
                                <i class="fas fa-pencil-alt"></i>Sửa
                            </a>
                            <a class="btn btn-sm btn-danger btn-action-delete"
                                data-url="/categoriesProduct/delete/{{$product_category->id}}">
                                <i class="fas fa-trash">
                                </i>
                                Xóa
                            </a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
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
