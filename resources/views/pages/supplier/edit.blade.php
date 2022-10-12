@extends('layout/masterLayout')
@section('title')
Nhà cung cấp
@endsection
@push('styles')
<style>

</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-12">Chỉnh sửa nhà cung cấp</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <form action="" method="POST">
        {{csrf_field() }}
        <div class="card-body">
@foreach($UpdateSL as $updateSl)
            <div class="form-group">
                <label for="Supplier">Tên Nhà Cung Cấp</label>
                <input type="text" name="supplier_name" class="form-control"  value="{{$updateSl->supplier_name}}">
            </div>
            <div class="form-group">
                <label for="Supplier">Hình Ảnh Nhà Cung Cấp</label>         
                <input type="file" name="supplier_photo" class="form-control" id ="Supplier">
            </div>
            <div class="form-group">
                <label for="Supplier">STT</label>
                <input type="number" name="supplier_order" class="form-control"   value="{{$updateSl->supplier_order}}">
            </div>
            <div class="form-group">
                <label for="Supplier">Hiển thị</label>
                @if( $updateSl->supplier_display==1)
                    <input style="margin-left:17px"; type="checkbox" checked="checked" name="supplier_display">
                @else
                    <input style="margin-left:17px"; type="checkbox" name="supplier_display">
                
                @endif
            </div>
            <div class="form-group">
                <label for="Supplier">Nổi bật</label>
                @if( $updateSl->supplier_display==1)
                    <input style="margin-left:17px"; type="checkbox" checked="checked" name="supplier_outstanding">
                @else
                    <input style="margin-left:17px"; type="checkbox" name="supplier_outstanding">
                
                @endif
            </div>
            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="supplier_desc" class="form-control" > {{$updateSl->supplier_desc}}</textarea>
            </div>
            <div class="form-group">
                <label>Địa chỉ </label>
                <textarea name="supplier_address" class="form-control" >{{$updateSl->supplier_address}}</textarea>
            </div>
            <div class="form-group">
                <label>Google Map</label>
                <input type="text" name="supplier_map" class="form-control"  value="{{$updateSl->supplier_map}}">
            </div>
            <div class="form-group">
                <label for="Supplier">Điện thoại</label>
                <input type="text" name="supplier_phone" class="form-control" value="{{$updateSl->supplier_phone}}">
            </div>
            <div class="form-group">
                <label for="Supplier">Email</label>
                <input type="email" name="supplier_email" class="form-control" value="{{$updateSl->supplier_email}}">
            </div>
        </div>
@endforeach
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
        @csrf
    </form>
</div>
@endsection
@push('scripts')
<script>

</script>
@endpush
@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection