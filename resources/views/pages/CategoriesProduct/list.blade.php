@extends('layout/masterLayout')
@section('title')
Danh mục sản phẩm
@endsection
@push('styles')
<style>

</style>
@endpush
@section('content')
<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">Danh sách các danh mục sản phẩm</div>
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
                    </tr>
                </thead>
                @foreach($product_categories as $product_categories)
                <tbody>
                    <tr>
                        <td>{{$product_categories->id}}</td>
                        <td>{{$product_categories->category_name}}</td>
                        <td>{{$product_categories->category_image}}</td>
                        <td>{{$product_categories->category_order}}</td>
                        <td>
                            @if($product_categories->parent_id == 0)
                            {{'Danh mục cha'}}
                            @else
                            {{'Danh mục con'}}
                            @endif
                        </td>
                        <td>
                            @if($product_categories->category_display == 0)
                            {{'Không'}}
                            @else
                            {{'Có'}}
                            @endif
                        </td>
                        <td>
                            @if($product_categories->category_outstanding == 0)
                            {{'Không'}}
                            @else
                            {{'Có'}}
                            @endif
                        </td>
                        <td>{{$product_categories->created_at}}</td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i>
                            <a href="{{route('categoryProduct.update',['id'=>$product_categories->id])}}">Sửa</a>
                        </td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                            <a href="CategoriesProduct/Delete/{{$product_categories->id}}"> Xóa</a>
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
<script>

</script>
@endpush
