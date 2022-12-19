@extends('layout/masterLayout')
@section('title')
Nhà cung cấp
@endsection
@push('style')
<style>
     th {
            font-size: 14px;
        }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row" style="padding-top:15px;padding-bottom:15px;">
        <div class="col-2">
            <button type="button" class="btn btn-success"><a href="{{route('supplier.add')}}" style="color:#fff">+ Thêm mới</a></button>
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
                        <th style="width:30%;">Tên nhà cung cấp</th>
                        <th>Thông tin</th>
                        <th>Hiển Thị</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @foreach($supplier as $supplier)
                <tbody>
                    <tr>
                        <td>{{$supplier->id}}</td>
                        <td>
                            @if($supplier->supplier_photo!=null)
                                <img style="width:100px" src="{{$supplier->supplier_photo}}">
                            @else
                                Trống
                            @endif
                        </td>
                        <td>{{$supplier->supplier_name}}</td>
                        <td>Địa chỉ: {{$supplier->supplier_address}}<br/>
                            Điện thoại: {{$supplier->supplier_phone}}<br/>
                            Email: {{$supplier->supplier_email}}
                        </td>
                        <td class="check">
                            <input type="checkbox" {{$supplier->supplier_display == 1 ? 'checked' : ''}}>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{route('supplier.update',['id'=>$supplier->id])}}">
                                <i class="fas fa-pencil-alt"></i>Sửa
                            </a>
                            <a class="btn btn-sm btn-danger btn-action-delete"
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
