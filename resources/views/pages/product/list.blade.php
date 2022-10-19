@extends('layout/masterLayout')
@section('title')
    {{$title}}
@endsection
@push('styles')
@endpush
<style>
    th{
        font-size:14px;
    }
    td{
        align-items:center;
        text-align:center;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-12">
                <div class="row">
                    <div class="col-2">
                        <button type="button" class="btn btn-dark"><a href="product/add" style="color:#fff">Thêm</a></button>
                        <button type="button" class="btn btn-warning">Xóa Chọn</button>
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
                <div class="row" style="padding:20px 0">
                    <div class="form-group col-3">
                        <select id="inputStatus" class="form-control custom-select">
                        <option selected="" disabled="">Danh mục cấp 1</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <select id="inputStatus" class="form-control custom-select">
                        <option selected="" disabled="">Danh mục cấp 2</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <select id="inputStatus" class="form-control custom-select">
                        <option selected="" disabled="">Danh mục cấp 3</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    @include('components.alert')
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:3%"><input type="checkbox" style="text-align:center;"></th>
                        <th style="width:5.5%">Thứ tự</th>
                        <th style="width:7%">Hình ảnh</th>
                        <th style="width:25%; text-align:center;">Tên sản phẩm</th>
                        <th style="width:6.5%">Phân loại</th>
                        <th style="width:6.5%">Lượt xem</th>
                        <th style="width:10%">Ngày tạo</th>
                        <th style="width:6%">Nổi bật</th>
                        <th style="width:6%" >Ẩn/hiện</th>
                        <th style="width:15%; text-align:center;">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $product)
                        <tr>
                            <td><input type="checkbox" style="text-align:center;"></td>
                            <td>{{$product->product_order}}</td>
                            <td>{{$product->product_image}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product}}</td>
                            <td>{{$product->product_views}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>@if($product->product_outstanding=='1')
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            </td>
                            <td>@if($product->product_display=='1')
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            </td>
                            <td class="text-right">
                                <a class="btn btn-info btn-sm" href="/product/update/{{$product->id}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" onlick="return Del({{$product->name}})" href="/product/delete/{{$product->id}}">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <hr/>
                    {{$data->links()}}
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
</div>
@endsection
<script>
    funciton Del(name)
    {
        return confirm('Bạn có chắc muốn xóa sản phẩm:'  + name + " ? ");
    }
</script>
