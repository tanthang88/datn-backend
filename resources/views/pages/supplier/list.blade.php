@extends('layout/masterLayout')
@section('title')
Nhà cung cấp
@endsection
@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">Danh sách nhà cung cấp</div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên nhà cung cấp</th>
                        <th>Hình ảnh</th>
                        <th>Số thứ tự</th>
                        <th>Hiển Thị</th>
                        <th>Nổi bật</th>
                        <th>Mô tả</th>
                        <th>Địa chỉ</th>
                        <th>Google Map</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Ngày Tạo</th>
                    </tr>
                </thead>
                @foreach($supplier as $supplier)
                <tbody>
                    <tr>
                        <td>{{$supplier->id}}</td>
                        <td>{{$supplier->supplier_name}}</td>
                        <td>{{$supplier->supplier_photo}}</td>
                        <td>{{$supplier->supplier_order}}</td>
                        <td>
                            @if($supplier->supplier_display == 0)
                            {{'Không'}}
                            @else
                            {{'Có'}}
                            @endif
                        </td>
                        <td>
                            @if($supplier->supplier_outstanding == 0)
                            {{'Không'}}
                            @else
                            {{'Có'}}
                            @endif
                        </td>
                        <td>{{$supplier->supplier_desc}}</td>
                        <td>{{$supplier->supplier_address}}</td>
                        <td>{{$supplier->supplier_map}}</td>
                        <td>{{$supplier->supplier_phone}}</td>
                        <td>{{$supplier->supplier_email}}</td>
                        <td>{{$supplier->created_at}}</td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                href="{{route('supplier.update',['id'=>$supplier->id])}}">Sửa</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="Delete/{{$supplier->id}}">
                                Xóa</a></td>
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
