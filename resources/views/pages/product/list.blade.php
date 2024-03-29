@extends('layout/masterLayout')
@section('title')
    {{ $title }}
@endsection
@push('styles')
@endpush
<style>
    th {
        font-size: 14px;
    }

    td,
    td a {
        text-align: center;
    }
</style>
@section('content')
    <?php
    use App\Models\Variantion;
    use App\Models\BillDetail;
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row" style="padding-top:15px;">
                    <div class="col-2">
                        <button type="button" class="btn btn-dark"><a href="{{route('product.add')}}" style="color:#fff">Thêm mới</a></button>
                    </div>
                    <form action="" class="col-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-success"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:5.5%">Thứ tự</th>
                            <th style="width:7%">Hình ảnh</th>
                            <th style="width:17%; text-align:center;">Tên sản phẩm</th>
                            <th style="width:6.5%">Phân loại</th>
                            <th style="width:6.5%">Lượt xem</th>
                            <th style="width:8%">Ngày tạo</th>
                            <th style="width:6%">Nổi bật</th>
                            <th style="width:6%">Bán chạy</th>
                            <th style="width:3%">Ẩn/hiện</th>
                            <th style="width:10%; text-align:center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $product)
                            <tr>
                                <td>{{ $product->product_order }}</td>
                                <td>
                                    @if ($product->product_image != '')
                                        <img style="width:80px;height:80px;object-fit: cover;"
                                            src="{{ $product->product_image }}">
                                    @endif
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->productCategory->category_name }}</td>
                                <td>{{ $product->product_views }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    @if ($product->product_outstanding == '1')
                                        <input type="checkbox" checked>
                                    @else
                                        <input type="checkbox">
                                    @endif
                                </td>
                                <td>
                                </td>
                                <td>
                                    @if ($product->product_display == '1')
                                        <input type="checkbox" checked>
                                    @else
                                        <input type="checkbox">
                                    @endif
                                </td>
                                <td class="text-right" style="margin:0 auto;">
                                    @if ($product->is_variation == '1')
                                        <?php $variantion = DB::table('variantions')
                                            ->where('product_id', $product->id)
                                            ->first();
                                        $object = '';
                                        if (empty($variantion)) {
                                            $object = 'add';
                                        } else {
                                            $object = 'update';
                                        }
                                        ?>
                                        <p style="padding-top:10px;">
                                            <a class="btn btn-dark btn-sm" style="background-color:#fff;color:#343a40;padding-right:24px;padding-left:24px;padding-top:7px;padding-bottom:7px;"
                                                href="/product/{{ $object }}Variant/{{ $product->id }}">
                                                <i class="fa fa-random icon-pd" aria-hidden="true"></i>
                                                Biến thể
                                            </a>
                                        </p>
                                    @endif
                                        <a class="btn btn-info btn-sm" href="/product/update/{{ $product->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Sửa
                                        </a>
                                        <a class="btn btn-danger btn-sm btn-action-delete"
                                            data-url="/product/delete/{{ $product->id }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Xóa
                                        </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr />
                {{ $data->links() }}
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
<script
    type="module"
    src="{{Vite::asset('resources/js/components/confirmDel.js')}}"
></script>
