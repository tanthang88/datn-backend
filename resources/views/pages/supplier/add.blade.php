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
              <div class="col-12">Thêm mới nhà cung cấp</div>
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

            <div class="form-group">
                <label for="Supplier">Tên Nhà Cung Cấp</label>
                <input type="text" name="supplier_name" class="form-control"  placeholder="Nhập tên nhà cung cấp" required>
            </div>
            <div class="form-group">
                <label for="Supplier">Hình Ảnh Nhà Cung Cấp</label>         
                <input type="file" name="supplier_photo" class="form-control" id = "Supplier" required>
            </div>
            <div class="form-group">
                <label for="Supplier">STT</label>
                <input type="number" name="supplier_order" class="form-control"  placeholder="Nhập số thứ tự" required>
            </div>
            <div class="form-group">
                <label for="Supplier">Hiển thị</label>
                <input style="margin-left:17px"; type="checkbox" name="supplier_display" >
            </div>
            <div class="form-group">
                <label for="Supplier">Nổi bật</label>
                <input style="margin-left:17px"; type="checkbox" name="supplier_outstanding" >
            </div>
            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="supplier_desc" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Địa chỉ </label>
                <textarea name="supplier_address" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Google Map</label>
                <input type="text" name="supplier_map" class="form-control"  placeholder="Nhập iframe ggmap">
            </div>
            <div class="form-group">
                <label for="Supplier">Điện thoại</label>
                <input type="text" name="supplier_phone" class="form-control"  placeholder="Nhập số điện thoại nhà cung cấp" required>
            </div>
            <div class="form-group">
                <label for="Supplier">Email</label>
                <input type="email" name="supplier_email" class="form-control"  placeholder="Nhập email điện thoại nhà cung cấp" required>
            </div>
       
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Mới</button>
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