@extends('layout/masterLayout')
@section('title')
Nhà cung cấp
@endsection
@push('style')
<style>
       #img_priv img{
        width:200px;
    }
</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <form action="" method="POST" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="card-body">

            <div class="form-group">
                <label for="Supplier">Tên Nhà Cung Cấp</label>
                <input type="text" name="supplier_name" class="form-control"  placeholder="Nhập tên nhà cung cấp" required>
            </div>
            <div class="form-group">
                <label for="Supplier">Hình Ảnh Nhà Cung Cấp</label>
                <input type="file" id="post_img"  name="supplier_photo" onchange="img_priv()" class="form-control">
                <div class="preview-upload" id="img_priv">

                </div>
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
                <textarea name="supplier_desc" id="pro_content" class="form-control"></textarea>
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
    function img_priv() {
   var fileSelected = document.getElementById('post_img').files;
   if (fileSelected.length > 0) {
           var fileToLoad = fileSelected[0];
           var fileReader = new FileReader();
           fileReader.onload = function(fileLoaderEvent) {
               var srcData = fileLoaderEvent.target.result;
               var newImage = document.createElement('img');
               newImage.src = srcData;
                       document.getElementById('img_priv').innerHTML = newImage.outerHTML;
                   }
                   fileReader.readAsDataURL(fileToLoad);

           }
   }
</script>
@endpush
@section('footer')
@endsection
