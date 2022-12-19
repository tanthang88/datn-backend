@extends('layout/masterLayout')
@section('title')
{{$title}}
@endsection
@push('style')
<style>
       #img_priv img{
        padding-top:10px;
        width: 200px;
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
                                    <button type="button" class="btn btn-warning"><a href="{{route('categoryProduct.list')}}" style="color:black"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="CategoryPd">Tên danh mục</label>
                                    <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="category_name" value="{{old('category_name')}}"  placeholder="Nhập tên danh mục sản phẩm">
                                    @error('category_name')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Loại Danh Mục</label>
                                    <select  name="parent_id" class="form-control">
                                        <option value="0"> Danh Mục Cha </option>
                                        @foreach($product_categories as $parent_cg)
                                        <option value="{{ $parent_cg->id }}">{{ $parent_cg->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Hình ảnh</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_img" name="category_image"  onchange="img_priv()">
                                        <label class="custom-file-label" for="post_img">Choose file</label>
                                    </div>
                                    <div class="preview-upload" id="img_priv">

                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="CategoryPd">Hiển thị</label>
                                    <input style="margin-left:17px"; type="checkbox" name="category_display" >
                                </div>
                                <div class="form-group col-12">
                                    <label for="CategoryPd">Nổi bật</label>
                                    <input style="margin-left:17px"; type="checkbox" checked name="category_outstanding" >
                                </div>
                                <div class="form-group col-12">
                                    <label>Mô Tả </label>
                                    <textarea name="category_desc" class="form-control">{{old('category_desc')}}</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label>Nội dung </label>
                                    <textarea name="category_content" id="pro_content" class="form-control">{{old('category_content')}}</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label>Title</label>
                                    <input type="text" name="seo_title" value="{{old('seo_title')}}" class="form-control"  placeholder="Nội dung thẻ Meta Title dùng để SEO">
                                </div>
                                <div class="form-group col-12">
                                    <label>SEO Keyword</label>
                                    <input type="text" name="seo_keywords" value="{{old('seo_keywords')}}" class="form-control"  placeholder="Từ khóa chính cho bài viết">
                                </div>
                                <div class="form-group col-12">
                                    <label>SEO Description</label>
                                    <input type="text" name="seo_description" value="{{old('seo_description')}}" class="form-control"  placeholder="Nội dung thẻ meta Description dùng để SEO ">
                                </div>
                            </div>
                        @csrf
                    </form>
                </div>
            </div>

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
