@extends('layout/masterLayout')
@section('title')
Banner
@endsection
@push('style')
<style>
#img_priv img{
    height: 360px;
    width: auto;
}
</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-12">Thêm mới Banner</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <form action="{{route('banner.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="Banner">Tiêu đề của Banner</label>
                <input type="text" name="title" class="form-control"  placeholder="Nhập tiêu đề của banner" required>
            </div>
            <div class="form-group">
                <label for="Banner">Hình ảnh</label>         
                <input id="image" type="file" onchange="img_priv()" name="image">
                <div class="preview-upload" id="img_priv">
                </div>
            </div>
            <div class="form-group">
                <label>Đường dẫn</label><br>
                <input type="text" name="link" class="form-control" >

            <div class="form-group">
                <label>type </label>
                <input type="text" name="type" class="form-control" >
            </div>
            <div class="form-group">
                <label for="Post">Hiển thị</label>
                <input style="margin-left:17px"; type="checkbox" name="display" checked >
            </div>      
           
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Mới</button>
        </div>    
    </form>
</div>

<script>
    function img_priv() {
        var fileSelected = document.getElementById('image').files;
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
@endsection

    