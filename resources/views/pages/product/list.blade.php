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
    td, td a{
        text-align:center;
    }
</style>
@section('content')
<?php
    use App\Models\Variantion;
?>
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
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

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:3%"><input type="checkbox" style="text-align:center;"></th>
                        <th style="width:5.5%">Thứ tự</th>
                        <th style="width:7%">Hình ảnh</th>
                        <th style="width:20%; text-align:center;">Tên sản phẩm</th>
                        <th style="width:6.5%">Phân loại</th>
                        <th style="width:6.5%">Lượt xem</th>
                        <th style="width:10%">Ngày tạo</th>
                        <th style="width:6%">Nổi bật</th>
                        <th style="width:6%" >Ẩn/hiện</th>
                        <th style="width:20%; text-align:center;">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $product)
                        <tr>
                            <td><input type="checkbox" style="text-align:center;"></td>
                            <td>{{$product->product_order}}</td>
                            <td>
                                @if($product->product_image != '')
                                    <img style="width:80px;height:80px;object-fit: cover;" src="{{$product->product_image}}">
                                @endif
                            </td>
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
                            <td class="text-right" style="margin:0 auto;">
                                @if($product->is_variation=='1')
                                <?php $variantion = DB::table('variantions')->where('product_id', $product->id)->first();
                                    $object = '';
                                    if(empty($variantion)) {
                                        $object = 'add';
                                    }else{
                                        $object = 'update';
                                    }
                                ?>
                                        <a class="btn btn-dark btn-sm" style="background-color:#fff;color:#343a40;" href="/product/{{$object}}Variant/{{$product->id}}">
                                            <i class="fa fa-random icon-pd" aria-hidden="true"></i>
                                            Biến thể
                                        </a>
                                @endif
                                <a class="btn btn-info btn-sm" href="{{route('product.update',['id'=>$product->id])}}">
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
