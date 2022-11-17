@extends('layout/masterLayout')
@section('title')
Nhà cung cấp
@endsection
@push('style')
<style>
 #img_priv img{
        height: 200px;
        width: auto;
}
.hide{
    display:none;
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
                <input type="text" name="supplier_name" class="form-control"  value="{{$UpdateSL->supplier_name}}">
            </div>
            <div class="form-group">
                <label for="Supplier">Hình Ảnh Nhà Cung Cấp</label>
                <input type="file" id="post_img"  name="supplier_photo" onchange="img_priv()" class="form-control">
                <div class="preview-upload" id="img_priv">
                    <div id="img_last">
                        @if($UpdateSL->supplier_photo != null)
                            <img src="{{$UpdateSL->supplier_photo}}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Supplier">STT</label>
                <input type="number" name="supplier_order" class="form-control"   value="{{$UpdateSL->supplier_order}}">
            </div>
            <div class="form-group">
                <label for="Supplier">Hiển thị</label>
                @if( $UpdateSL->supplier_display==1)
                    <input style="margin-left:17px"; type="checkbox" checked="checked" name="supplier_display">
                @else
                    <input style="margin-left:17px"; type="checkbox" name="supplier_display">

                @endif
            </div>
            <div class="form-group">
                <label for="Supplier">Nổi bật</label>
                @if( $UpdateSL->supplier_display==1)
                    <input style="margin-left:17px"; type="checkbox" checked="checked" name="supplier_outstanding">
                @else
                    <input style="margin-left:17px"; type="checkbox" name="supplier_outstanding">

                @endif
            </div>
            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="supplier_desc" id="pro_content" class="form-control" > {{$UpdateSL->supplier_desc}}</textarea>
            </div>
            <div class="form-group">
                <label>Địa chỉ </label>
                <textarea name="supplier_address" class="form-control" >{{$UpdateSL->supplier_address}}</textarea>
            </div>
            <div class="form-group">
                <label>Google Map</label>
                <input type="text" name="supplier_map" class="form-control"  value="{{$UpdateSL->supplier_map}}">
            </div>
            <div class="form-group">
                <label for="Supplier">Điện thoại</label>
                <input type="text" name="supplier_phone" class="form-control" value="{{$UpdateSL->supplier_phone}}">
            </div>
            <div class="form-group">
                <label for="Supplier">Email</label>
                <input type="email" name="supplier_email" class="form-control" value="{{$UpdateSL->supplier_email}}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
        @csrf
    </form>
</div>
@endsection
@push('scripts')
<script>
    function img_priv() {
    var fileSelected = document.getElementById('post_img').files;
    var imgLast = document.getElementById('img_last');
    if (fileSelected.length > 0) {
            imgLast.classList.add("hide");
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
