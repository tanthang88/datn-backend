@extends('layout/masterLayout')
@section('title')
{{$title}}
@endsection
@push('style')
<style>
#img_priv img{
    width: 200px;
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{csrf_field() }}
                        <div class="row" style="padding-bottom:20px;">
                            <div class="col-3">
                                <button type="submit" class="btn btn-success"><i class="fas fa-check" aria-hidden="true" style="padding-right:3px;"></i>Hoàn tất</button>
                                <button type="button" class="btn btn-warning"><a href="{{route('post.list')}}" style="color:black"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="Post">Tên bài viết</label>
                                <input type="text" name="post_name" id="post_name" class="form-control @error('post_name') is-invalid @enderror" value="{{old('post_name')}}"  placeholder="Nhập tiêu đề bài viết">
                                @error('post_name')
                                <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Danh mục bài viết</label>
                                <select  name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach($post_categories as $post_categories)
                                        <option value="{{ $post_categories->id }} {{ old('category_id') == $post_categories->id ? "selected" : "" }}">{{ $post_categories->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Post">Ảnh bìa</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="post_img" name="post_img"  onchange="img_priv()">
                                <label class="custom-file-label" for="post_img">Choose file</label>
                            </div>
                            <div class="preview-upload" id="img_priv">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Post">Hiển thị</label>
                            <input style="margin-left:17px" type="checkbox" name="post_display" checked >
                        </div>
                        <div class="form-group">
                            <label for="Post">Nổi bật</label>
                            <input style="margin-left:17px"; type="checkbox" name="post_outstanding" checked>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả ngắn  </label><br>
                            <textarea name="post_desc" class="form-control">{{old('post_desc')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung bài viết </label><br>
                            <textarea name="content" id="pro_content">{{old('content')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label> Seo Title</label>
                            <input type="text" name="post_seo_title" class="form-control" value="{{old('post_seo_title')}}"  placeholder="Nội dung thẻ Meta Title dùng để SEO">
                        </div>
                        <div class="form-group">
                            <label>SEO Keyword</label>
                            <input type="text" name="post_seo_keyword" class="form-control" value="{{old('post_seo_keyword')}}"  placeholder="Từ khóa chính cho bài viết">
                        </div>
                        <div class="form-group">
                            <label>SEO Description</label>
                            <input type="text" name="post_seo_description" class="form-control" value="{{old('post_seo_description')}}"  placeholder="Nội dung thẻ meta Description dùng để SEO ">
                        </div>
                        @csrf

                    </form>
                </div>
        </div><!-- /.container-fluid -->

    <!-- /.content -->
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




