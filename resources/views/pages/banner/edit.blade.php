@extends('layout/masterLayout')
@section('title')
{{$title}}
@endsection
@push('style')
<style>
#img_priv img{
        width:200px;
        padding-top:10px;
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
            <div class="card card-primary row">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                    {{-- @if($banner->updated_at!='')
                        <h3 class="card-title" style="float:right;">Cập nhật vào: {{$banner->updated_at}}</h3>
                    @else
                        <h3 class="card-title" style="float:right;">Thêm mới vào: {{$banner->created_at}}</h3>
                    @endif --}}
                </div>
                <div class="card-body">
                    <form  action="{{route('banner.update',['id' =>$banner->id]) }}" method="POST" enctype="multipart/form-data">
                            <div class="row" style="padding-bottom:20px;">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check" aria-hidden="true" style="padding-right:3px;"></i>Hoàn tất</button>
                                    <button type="button" class="btn btn-warning"><a href="{{route('banner.list')}}" style="color:black"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="banner">Tiêu đề</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{$banner->title}}">
                                @error('title')
                                <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image"  onchange="img_priv()">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div id="img_now"><img width="200px" style="padding-top:10px" src="{{$banner->image}}"></div>
                                <div class="preview-upload" id="img_priv">
                            </div>
                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input type="text" name="link" class="form-control" value="{{$banner->link}}" placeholder="Link đường dẫn banner">
                            </div>
                            <div class="form-group">
                                <label>Hiển thị</label>
                                <input style="margin-left:17px" type="checkbox" name="display" {{$banner->display==1 ? 'checked' : ''}}>
                            </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->

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






