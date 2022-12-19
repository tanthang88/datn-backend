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
                        <th>Nổi bật</th>
                        <th>Hiển Thị</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @foreach($product_categories as $product_categories)
                <tbody>
                    <tr>
                        <td>{{$product_categories->id}}</td>
                        <td>
                            @if ($product_categories->category_image!=null)
                                <img style="width:80px;height:80px;object-fit: cover;" src="{{$product_categories->category_image}}">
                            @else
                                Trống
                            @endif
                        </td>
                        <td>{{$product_categories->category_name}}</td>
                        <td>
                            @if($product_categories->parent_id == 0)
                                Danh mục cha
                            @else
                                Danh mục con
                            @endif
                        </td>
                        <td class="check">
                            <input type="checkbox" {{$product_categories->category_outstanding ==1 ? 'checked' : ''}}>
                        </td>
                        <td class="check">
                            <input type="checkbox" {{$product_categories->category_display ==1 ? 'checked' : ''}}>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{route('categoryProduct.update',['id'=>$product_categories->id])}}">
                                <i class="fas fa-pencil-alt"></i>Sửa
                            </a>
                            <a class="btn btn-sm btn-danger btn-action-delete"
                                data-url="/categoriesProduct/delete/{{$product_categories->id}}">
                                <i class="fas fa-trash">
                                </i>
                                Xóa
                            </a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
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
