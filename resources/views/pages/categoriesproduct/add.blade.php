@extends('layout/masterLayout')
@section('title')
Danh mục sản phẩm
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
              <div class="col-12">Thêm danh mục sản phẩm</div>
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
                <label for="CategoryPd">Tên danh mục</label>
                <input type="text" name="category_name" class="form-control"  placeholder="Nhập tên danh mục sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="CategoryPd">Tên không dấu</label>
                <input type="text" name="category_slug" class="form-control"  placeholder="Nhập tên không dấu" required>
            </div>
            <div class="form-group">
                <label for="CategoryPd">Hình Ảnh</label>         
                <input type="file" name="category_image" class="form-control" id = "Supplier" required>
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
                <input style="margin-left:17px"; type="checkbox" name="category_outstanding" >
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

</script>
@endpush
