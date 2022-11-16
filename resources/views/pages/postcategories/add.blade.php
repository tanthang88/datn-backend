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
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-12">Thêm loại danh mục bài viết</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <form action="" method="POST">
        {{csrf_field() }}
        <div class="card-body">

            <div class="form-group">
                <label for="CategoryPost">Tên loại bài viết</label>
                <input type="text" name="category_name" class="form-control"  placeholder="Nhập tên loại tin" required>
            </div>
            <div class="form-group">
                <label for="CategoryPost">STT</label>
                <input type="number" name="category_order" class="form-control"  placeholder="Nhập số thứ tự" required>
            </div>
            <div class="form-group">
                <label for="CategoryPost">Hiển thị</label>
                <input style="margin-left:17px"; type="checkbox" name="category_display" checked>
            </div>
            <div class="form-group">
                <label for="CategoryPost">Nổi bật</label>
                <input style="margin-left:17px"; type="checkbox" name="category_outstanding" checked >
            </div>
            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="category_desc" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Nội dung </label>
                <textarea name="category_content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="CategoryPost">Type</label>
                <input type="text" name="type" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="category_title" class="form-control"  placeholder="Nội dung thẻ Meta Title dùng để SEO">
            </div>
            <div class="form-group">
                <label>SEO Keyword</label>
                <input type="text" name="seo_keyword" class="form-control"  placeholder="Từ khóa chính cho bài viết">
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

</script>
@endpush
