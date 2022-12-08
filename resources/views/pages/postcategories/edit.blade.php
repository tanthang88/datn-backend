@extends('layout/masterLayout')
@section('title')
Danh mục bài viết
@endsection
@push('styles')
<style>

</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <form action="" method="POST">
        {{csrf_field() }}
        <div class="card-body">
            <div class="form-group">
                <label for="CategoryPost">Tên loại bài viết</label>
               <input type="text" name="category_name" class="form-control"  value="{{$updateCPost->category_name}}" required>
            </div>
            <div class="form-group">
                <label for="CategoryPost">STT</label>
                <input type="number" name="category_order" class="form-control"  value="{{$updateCPost->category_order}}" required>
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
            {{-- <div class="form-group">
                <label for="CategoryPost">Type</label>
                <input type="text" name="type" class="form-control" value="{{$updateCPost->type}}" required>
            </div> --}}
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="category_title" class="form-control"  value="{{$updateCPost->category_title}}">
            </div>
            <div class="form-group">
                <label>SEO Keyword</label>
                <input type="text" name="seo_keyword" class="form-control"   value="{{$updateCPost->seo_keyword}}">
            </div>
            <div class="form-group">
                <label>SEO Description</label>
                <input type="text" name="seo_description" class="form-control" value="{{$updateCPost->seo_description}}">
            </div>
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

</script>
@endpush
