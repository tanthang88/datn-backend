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
</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <div class="card card-primary row">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('banner.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row" style="padding-bottom:20px;">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check" aria-hidden="true" style="padding-right:3px;"></i>Hoàn tất</button>
                                    <button type="button" class="btn btn-warning"><a href="{{route('banner.list')}}" style="color:black"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a></button>
                                </div>
                            </div>
                             <div class="form-group">
                                 <label for="Slider">Tiêu đề</label>
                                 <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}"  placeholder="Nhập tiêu đề của banner">
                                 @error('title')
                                 <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="">Hình ảnh</label>
                                 <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image"  onchange="img_priv()">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                @error('image')
                                <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                @enderror
                                <div class="preview-upload" id="img_priv">
                                </div>
                             </div>
                             <div class="form-group">
                                 <label>Đường dẫn</label><br>
                                 <input type="text" name="link" value="{{old('link')}}" class="form-control" placeholder="Link đường dẫn banner">
                             </div>
                             <div class="form-group">
                                <label for="Post">Hiển thị</label>
                                <input style="margin-left:17px" type="checkbox" name="display" checked >
                            </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- /.content -->

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

