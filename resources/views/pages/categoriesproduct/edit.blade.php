@extends('layout/masterLayout')
@section('title')
Danh mục sản phẩm
@endsection
@push('style')
<style>
    #img_priv img{
        height: 200px;
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
        </div><!-- /.container-fluid -->
    <!-- /.content -->
    <form action="" method="POST" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="card-body">
            @foreach($updateCP as $updateCP)
            <div class="form-group">
                <label for="CategoryPd">Tên danh mục</label>
                <input type="text" name="category_name" class="form-control"  value="{{$updateCP->category_name}}" required>
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input id="post_img" type="file" onchange="img_priv()" name="category_image">
                <div class="preview-upload" id="img_priv">
                    <div id="img_last">
                        @if($updateCP->category_image)
                            <img src="{{$updateCP->category_image}}">
                        @endif
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label for="CategoryPd">STT</label>
                <input type="number" name="category_order" class="form-control"  value="{{$updateCP->category_order}}" required>
            </div>
            <div class="form-group">
                <label>Loại Danh Mục</label>
                <select  name="parent_id" class="form-control">
                    @if($parent_id_val !=0)
                        <option value="{{$parent_id_val}}">{{$parent_name_val}} </option>
                    @endif
                    <option value="0"> Danh Mục Cha </option>
                    @foreach($product_categories as $parent_cg)
                    <option value="{{ $parent_cg->id }}">{{ $parent_cg->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="CategoryPd">Hiển thị</label>
                <input style="margin-left:17px"; type="checkbox" name="category_display" {{$updateCP->category_display=='1' ? 'checked' : ''}}>
            </div>
            <div class="form-group">
                <label for="CategoryPd">Nổi bật</label>
                <input style="margin-left:17px"; type="checkbox" name="category_outstanding" {{$updateCP->category_outstanding=='1' ? 'checked' : ''}}>
            </div>
            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="category_desc" class="form-control">{{$updateCP->category_desc}}</textarea>
            </div>
            <div class="form-group">
                <label>Nội dung </label>
                <textarea name="category_content" id="pro_content" class="form-control">{{$updateCP->category_content}}</textarea>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="seo_title" class="form-control"  value="{{$updateCP->seo_title}}">
            </div>
            <div class="form-group">
                <label>SEO Keyword</label>
                <input type="text" name="seo_keywords" class="form-control"  value="{{$updateCP->seo_keywords}}">
            </div>
            <div class="form-group">
                <label>SEO Description</label>
                <input type="text" name="seo_description" class="form-control"  value="{{$updateCP->seo_description}}">
            </div>
            @endforeach
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
        @csrf
    </form>
</div>
@endsection
@push('scripts')
    <script>
    function img_priv() {
        var fileSelected = document.getElementById('post_img').files;
        var imgLast = document.getElementById('img_last');
        if (fileSelected.length > 0) {
                imgLast.classList.add("hide");
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
