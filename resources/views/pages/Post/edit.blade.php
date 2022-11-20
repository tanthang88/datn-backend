@extends('layout/masterLayout')
@section('title')
Bài viết
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
              <div class="col-12">Sửa bài viết</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        <form action="" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">   
                <div class="form-group">
                    <label>Danh mục bài viết</label>
                    <select  class="form-control" name="category_id">
                        @foreach($post_categories as $post_categorie)
                        <option  {{($post_categorie->id== $category_id) ?' selected':''}} value="{{$post_categorie->id}}">{{$post_categorie->category_name}}</option>                 
                        @endforeach
                    </select>
                </div> 
                <div class="form-group">
                    <label for="Post">Tiêu đề bài viết</label>
                    <input type="text" name="post_name" class="form-control" value="{{$posts->post_name}}" required>
                </div>
               <div class="form-group">
                    <label for="Post">STT</label>
                    <input type="number" name="post_order" class="form-control"  value="{{$posts->post_order}}" required>
                </div>
                <div class="form-group">
                    <label>Ảnh bìa</label>
                    <div id="img_now"><img width="400px" src="{{$posts->post_img}}"></div>
                    <input id="post_img" type="file" onchange="img_priv()" name="post_img">
                    <div class="preview-upload" id="img_priv">
                </div>
                <div class="form-group">
                    <label for="Post">Hiển thị</label>
                    @if($posts->post_display==1)
                    <input style="margin-left:17px"; type="checkbox" name="post_display" checked >
                    @else
                    <input style="margin-left:17px"; type="checkbox" name="post_display"  >
                    @endif
                </div>
                <div class="form-group">
                    <label for="Post">Nổi bật</label>
                    @if($posts->post_outstanding==1)
                    <input style="margin-left:17px"; type="checkbox" name="post_outstanding"  checked>
                    @else
                    <input style="margin-left:17px"; type="checkbox" name="post_outstanding"  >
                    @endif
                </div>
                <div class="form-group">
                    <label>Type </label>
                    <input type="text" name="type" class="form-control" value="{{$posts->type}}">
                </div>
                <div class="form-group">
                    <label>Mô Tả ngắn  </label><br>
                    <textarea name="post_desc" class="form-control">{{$posts->post_desc}}</textarea>           
                </div>
                <div class="form-group">
                    <label>Nội dung bài viết</label>
                    <textarea class="col-10 form-control" name="content" id="pro_content" rows="3">{{$posts->post_content}}</textarea>
                    </select>
                </div>
                <div class="form-group">
                    <label> Seo Title</label>
                    <input type="text" name="post_seo_title" class="form-control" value="{{$posts->post_seo_title}}">
                </div>
                <div class="form-group">
                    <label>SEO Keyword</label>
                    <input type="text" name="post_seo_keyword" class="form-control"  value="{{$posts->post_seo_keyword}}">
                </div>
                <div class="form-group">
                    <label>SEO Description</label>
                    <input type="text" name="post_seo_description" class="form-control"  value="{{$posts->post_seo_description}}">
                </div>
                
            </div>   
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        @csrf    
        </form>
    <!-- /.content -->
</div>

<script>
function img_priv() {
    var fileSelected = document.getElementById('post_img').files;
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





