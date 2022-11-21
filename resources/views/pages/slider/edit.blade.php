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
.hide{
    display:none;
}
</style>
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-12">Cập nhật slider</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <form  action="{{route('slider.update',['id' =>$slider->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="card-body">  
            <div class="form-group">
                <label for="Slider">Tiêu đề của slider</label>
                <input type="text" name="title" class="form-control" value="{{$slider->title}}" required>
            </div>
            <div class="form-group">
                <label>Hình ảnh</label>
                <div id="img_now"><img width="400px" src="{{$slider->image}}"></div>
                <input id="image" type="file" onchange="img_priv()" name="image">
                <div class="preview-upload" id="img_priv">
            </div>
            <div class="form-group">
                <label>Đường dẫn</label>
                <input type="text" name="link" class="form-control" value="{{$slider->link}}">
            </div>
            <div class="form-group">
                <label>Type </label>
                <input type="text" name="type" class="form-control" value="{{$slider->type}}">
            </div>
            <div class="form-group">
                <label>Mô tả</label><br>
                <textarea name="desc" class="form-control">{{$slider->desc}}</textarea>           
            </div>
            <div class="form-group">
                <label>Nội dung</label><br>
                <textarea name="content"  class="form-control" id="content">{{$slider->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="Post">Hiển thị</label>
                @if($slider->display==1)
                <input style="margin-left:17px"; type="checkbox" name="display" checked >
                @else
                <input style="margin-left:17px"; type="checkbox" name="display"  >
                @endif
            </div>
            <div class="form-group">
                <label for="Post">STT</label>
                <input type="number" name="order" class="form-control"  value="{{$slider->order}}" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
       
    </form>
</div>

<script>
function img_priv() {
    var fileSelected = document.getElementById('image').files;
    var imgNow = document.getElementById('img_now');
    if (fileSelected.length > 0) {
            var fileToLoad = fileSelected[0];
            var fileReader = new FileReader();
            fileReader.onload = function(fileLoaderEvent) {
                imgNow.classList.add('hide');
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






