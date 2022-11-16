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
              <div class="col-12">Sửa danh mục sản phẩm</div>
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
            @foreach($updateCP as $updateCP)
            <div class="form-group">
                <label for="CategoryPd">Tên danh mục</label>
                <input type="text" name="category_name" class="form-control"  value="{{$updateCP->category_name}}" required>
            </div>
            <div class="form-group">
                <label for="CategoryPd">Tên không dấu</label>
                <input type="text" name="category_slug" class="form-control"  value="{{$updateCP->category_slug}}" required>
            </div>
            <div class="form-group">
                <label for="CategoryPd">Hình Ảnh</label>         
                <input type="file" name="category_image" class="form-control" value="{{$updateCP->category_image}}" required>
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
                <input style="margin-left:17px"; type="checkbox" name="category_display" value="{{$updateCP->category_display}}">
            </div>
            <div class="form-group">
                <label for="CategoryPd">Nổi bật</label>
                <input style="margin-left:17px"; type="checkbox" name="category_outstanding" value="{{$updateCP->category_outstanding}}">
            </div>
            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="category_desc" class="form-control">{{$updateCP->category_desc}}</textarea>
            </div>
            <div class="form-group">
                <label>Nội dung </label>
                <textarea name="category_content" class="form-control">{{$updateCP->category_content}}</textarea>
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

</script>
@endpush
