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
              <div class="col-12">Danh sách các loại bài viết</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Tên bài viết</th>
                    <th>Số thứ tự</th>
                    <th>Hiển Thị</th>
                    <th>Nổi bật</th>
                    <th>Mô Tả</th>
                    <th>Nội dung</th>
                    <th>Ngày Tạo</th>
                    </tr>
                    </thead>
                    @foreach($post_categories as $post_categories)
                        <tbody>
                            <tr>
                                <td>{{$post_categories->id}}</td>
                                <td>{{$post_categories->category_name}}</td>
                                <td>{{$post_categories->category_order}}</td>
                                <td>
                                    @if($post_categories->category_display == 0)
                                    {{'Không'}}
                                    @else
                                    {{'Có'}}
                                    @endif
                                </td>

                                <td>
                                    @if($post_categories->category_outstanding == 0)
                                    {{'Không'}}
                                    @else
                                    {{'Có'}}
                                    @endif
                                </td>
                                <td>{{$post_categories->category_desc}}</td>
                                <td>{{$post_categories->category_content}}</td>
                                <td>{{$post_categories->created_at}}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="/PostCategories/Update/{{$post_categories->id}}">Sửa</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="/PostCategories/Delete/{{$post_categories->id}}"> Xóa</a></td>
                            </tr>

                            </tbody>
                    @endforeach

                    </table>
                    </div>
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <?php
    $message = Session::get('message');
    if ($message){
        echo '<p>' . $message . '<p>';
        Session::put('message', null);
    }
     ?>
</div>

@endsection
@push('scripts')
<script>

</script>
@endpush
