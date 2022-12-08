@extends('layout/masterLayout')
@section('title')
Bài viết
@endsection

@push('style')
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
            <!-- Small boxes (Stat box) -->

        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <form action="" method="POST" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="card-body">
            <div class="form-group">
                <label for="Post">Tiêu đề bài viết</label>
                <input type="text" name="post_name" class="form-control"  placeholder="Nhập tiêu đề bài viết" required>
            </div>
            <div class="form-group">
                <label>Danh mục bài viết</label>
                <select  name="category_id" class="form-control">
                    @foreach($post_categories as $post_categories)
                    <option value="{{ $post_categories->id }}">{{ $post_categories->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Post">STT</label>
                <input type="number" name="post_order" class="form-control"  placeholder="Nhập số thứ tự" required>
            </div>
            <div class="form-group">
                <label for="Post">Ảnh bìa</label>
                <input id="post_img" type="file" onchange="img_priv()" name="post_img">
                <div class="preview-upload" id="img_priv">

                </div>
            </div>

            <div class="form-group">
                <label for="Post">Hiển thị</label>
                <input style="margin-left:17px"; type="checkbox" name="post_display" checked >
            </div>
            <div class="form-group">
                <label for="Post">Nổi bật</label>
                <input style="margin-left:17px"; type="checkbox" name="post_outstanding" checked>
            </div>
            {{-- <div class="form-group">
                <label>type </label>
                <textarea name="type" class="form-control"></textarea>
            </div> --}}
            <div class="form-group">
                <label>Mô Tả ngắn  </label><br>
                <textarea name="post_desc" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Nội dung bài viết </label><br>
                <textarea name="content" id="pro_content"></textarea>
            </div>
            <div class="form-group">
                <label> Seo Title</label>
                <input type="text" name="post_seo_title" class="form-control"  placeholder="Nội dung thẻ Meta Title dùng để SEO">
            </div>
            <div class="form-group">
                <label>SEO Keyword</label>
                <input type="text" name="post_seo_keyword" class="form-control"  placeholder="Từ khóa chính cho bài viết">
            </div>
            <div class="form-group">
                <label>SEO Description</label>
                <input type="text" name="post_seo_description" class="form-control"  placeholder="Nội dung thẻ meta Description dùng để SEO ">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Mới</button>
        </div>
        @csrf

    </form>
</div>

@endsection

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




