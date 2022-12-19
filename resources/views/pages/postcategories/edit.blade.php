@extends('layout/masterLayout')
@section('title')
{{$title}}
@endsection
@push('styles')
<style>

</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <div class="card card-primary row">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                    @if($updateCPost->updated_at!='')
                        <h3 class="card-title" style="float:right;">Cập nhật vào: {{$updateCPost->updated_at}}</h3>
                    @elseif ($updateCPost->created_at!='')
                        <h3 class="card-title" style="float:right;">Thêm mới vào: {{$updateCPost->created_at}}</h3>
                    @else
                    @endif
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        {{csrf_field() }}
                        <div class="row" style="padding-bottom:20px;">
                            <div class="col-3">
                                <button type="submit" class="btn btn-success"><i class="fas fa-check" aria-hidden="true" style="padding-right:3px;"></i>Hoàn tất</button>
                                <button type="button" class="btn btn-warning"><a href="{{route('postCategory.list')}}" style="color:black"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CategoryPost">Tên danh mục bài viết</label>
                            <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{$updateCPost->category_name}}" Nhập tên danh mục bài viết>
                            @error('category_name')
                            <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="CategoryPost">Hiển thị</label>
                            @if($updateCPost->category_display==1)
                            <input style="margin-left:17px"; type="checkbox" name="category_display" checked >
                            @else
                            <input style="margin-left:17px"; type="checkbox" name="category_display"  >
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="CategoryPost">Nổi bật</label>
                            @if($updateCPost->category_outstanding==1)
                            <input style="margin-left:17px"; type="checkbox" name="category_outstanding"  checked>
                            @else
                            <input style="margin-left:17px"; type="checkbox" name="category_outstanding"  >
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Mô Tả </label>
                            <textarea name="category_desc" class="form-control">{{$updateCPost->category_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung </label>
                            <textarea name="category_content" id="pro_content"class="form-control">{{$updateCPost->category_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="category_title" class="form-control"  value="{{$updateCPost->category_title}}" placeholder="Nội dung thẻ Meta Title dùng để SEO">
                        </div>
                        <div class="form-group">
                            <label>SEO Keyword</label>
                            <input type="text" name="seo_keyword" class="form-control"   value="{{$updateCPost->seo_keyword}}" placeholder="Từ khóa chính cho bài viết">
                        </div>
                        <div class="form-group">
                            <label>SEO Description</label>
                            <input type="text" name="seo_description" class="form-control" value="{{$updateCPost->seo_description}}" placeholder="Nội dung thẻ meta Description dùng để SEO ">
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    <!-- /.content -->
</div>
@endsection
@push('scripts')
<script>

</script>
@endpush
