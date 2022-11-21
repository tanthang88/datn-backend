@extends('layout/masterLayout')
@section('title')
Slider
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
              <div class="col-12">Thêm mới slider</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <form action="{{route('slider.add') }}" method="POST" enctype="multipart/form-data">
       @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="Slider">Tiêu đề của slider</label>
                <input type="text" name="title" class="form-control"  placeholder="Nhập tiêu đề của silde" required>
            </div>
            <div class="form-group">
                <label for="Slider">Hình ảnh</label>         
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
                <label>Mô tả</label>
                <input type="text" name="desc" class="form-control" >
            </div>
            <div class="form-group">
                <label>Nội dung</label>
                <textarea name="content" class="form-control"></textarea>           

            </div>
            <div class="form-group">
                <label for="Post">Hiển thị</label>
                <input style="margin-left:17px"; type="checkbox" name="display" checked >
            </div>      
            <div class="form-group">
                <label>STT</label>
                <input type="number" name="order" class="form-control" required>
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

    