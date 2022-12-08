@extends('layout/masterLayout')
@section('title')
Danh mục sản phẩm
@endsection
@push('styles')
<style>
       #img_priv img{
        width: 200px;
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
                <label for="CategoryPd">Tên danh mục</label>
                <input type="text" name="category_name" class="form-control"  placeholder="Nhập tên danh mục sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input id="post_img" type="file" onchange="img_priv()" name="category_image">
                <div class="preview-upload" id="img_priv">

                </div>
            </div>
            <div class="form-group">
                <label for="CategoryPd">STT</label>
                <input type="number" name="category_order" class="form-control"  placeholder="Nhập số thứ tự" required>
            </div>
            <div class="form-group">
                <label>Loại Danh Mục</label>
                <select  name="parent_id" class="form-control">
                    <option value="0"> Danh Mục Cha </option>
                    @foreach($product_categories as $parent_cg)
                    <option value="{{ $parent_cg->id }}">{{ $parent_cg->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="CategoryPd">Hiển thị</label>
                <input style="margin-left:17px"; type="checkbox" name="category_display" >
            </div>
            <div class="form-group">
                <label for="CategoryPd">Nổi bật</label>
                <input style="margin-left:17px"; type="checkbox" checked name="category_outstanding" >
            </div>
            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="category_desc" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Nội dung </label>
                <textarea name="category_content" id="pro_content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="seo_title" class="form-control"  placeholder="Nội dung thẻ Meta Title dùng để SEO">
            </div>
            <div class="form-group">
                <label>SEO Keyword</label>
                <input type="text" name="seo_keywords" class="form-control"  placeholder="Từ khóa chính cho bài viết">
            </div>
            <div class="form-group">
                <label>SEO Description</label>
                <input type="text" name="seo_description" class="form-control"  placeholder="Nội dung thẻ meta Description dùng để SEO ">
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
