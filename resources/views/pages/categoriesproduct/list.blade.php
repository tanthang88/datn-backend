@extends('layout/masterLayout')
@section('title')
Danh mục sản phẩm
@endsection
@push('style')
<style>
    td.check{
        text-align:center;
    }
</style>
@endpush
@section('content')
<!-- Main content -->
<div class="container-fluid">
    <div class="row" style="padding-top:15px;padding-bottom:15px;">
        <div class="col-2">
            <button type="button" class="btn btn-dark"><a href="{{route('categoryProduct.add')}}" style="color:#fff">Thêm mới</a></button>
        </div>
        <form action="" class="col-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Danh Mục</th>
                        <th>Hình ảnh</th>
                        <th>Số thứ tự</th>
                        <th>Loại danh mục</th>
                        <th>Hiển Thị</th>
                        <th>Nổi bật</th>
                        <th>Ngày Tạo</th>
                        <th style="text-align:center;">Thao tác</th>
                    </tr>
                </thead>
                @foreach($product_categories as $product_categories)
                <tbody>
                    <tr>
                        <td>{{$product_categories->id}}</td>
                        <td>{{$product_categories->category_name}}</td>
                        <td><img style="width:80px;height:80px;object-fit: cover;" src="{{$product_categories->category_image}}"></td>
                        <td>{{$product_categories->category_order}}</td>
                        <td>
                            @if($product_categories->parent_id == 0)
                            {{'Danh mục cha'}}
                            @else
                            {{'Danh mục con'}}
                            @endif
                        </td>
                        <td class="check">
                            <input type="checkbox" {{$product_categories->category_display ==1 ? 'checked' : ''}}>
                        </td>
                        <td class="check">
                            <input type="checkbox" {{$product_categories->category_outstanding ==1 ? 'checked' : ''}}>
                        </td>
                        <td>{{$product_categories->created_at}}</td>
                        <td>
                            <a class="btn btn-info" href="{{route('categoryProduct.update',['id'=>$product_categories->id])}}">
                                <i class="fas fa-pencil-alt"></i>Sửa
                            </a>
                            <a class="btn btn-danger btn-action-delete"
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
