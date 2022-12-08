@extends('layout/masterLayout')
@section('title')
Nhà cung cấp
@endsection
@push('style')
<style>
    td.check{
        text-align:center;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row" style="padding-top:15px;padding-bottom:15px;">
        <div class="col-2">
            <button type="button" class="btn btn-dark"><a href="{{route('supplier.add')}}" style="color:#fff">Thêm mới</a></button>
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
                        <th>Tên nhà cung cấp</th>
                        <th>Hình ảnh</th>
                        <th>Hiển Thị</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Ngày Tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @foreach($supplier as $supplier)
                <tbody>
                    <tr>
                        <td>{{$supplier->id}}</td>
                        <td>{{$supplier->supplier_name}}</td>
                        <td>
                            @if($supplier->supplier_name)
                                <img style="width:80px; height:80px;" src="{{$supplier->supplier_photo}}">
                            @endif
                        </td>
                        <td class="check">
                            <input type="checkbox" {{$supplier->supplier_display == 1 ? 'checked' : ''}}>
                        </td>
                        <td>{{$supplier->supplier_address}}</td>
                        <td>{{$supplier->supplier_phone}}</td>
                        <td>{{$supplier->supplier_email}}</td>
                        <td>{{$supplier->created_at}}</td>
                        <td>
                            <a class="btn btn-info" href="{{route('supplier.update',['id'=>$supplier->id])}}">
                                <i class="fas fa-pencil-alt"></i>Sửa
                            </a>
                            <a class="btn btn-danger btn-action-delete"
                                data-url="{{route('supplier.delete',['id'=>$supplier->id])}}">
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
