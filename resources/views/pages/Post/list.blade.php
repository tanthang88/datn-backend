@extends('layout/masterLayout')
@section('title')
Bài viết
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
            <div class="row" style="padding-top:15px;padding-bottom:15px;">
                <div class="col-2">
                    <button type="button" class="btn btn-dark"><a href="{{route('post.add')}}" style="color:#fff">Thêm mới</a></button>
                </div>
                <form action="" class="col-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Main row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Tiêu đề bài viết</th>
                    <th>Hình ảnh</th>
                    <th>Thuộc danh mục</th>
                    <th>Hiển Thị</th>
                    <th>Nổi bật</th>
                    <th>Ngày Tạo</th>
                    <th>Thao tác</th>
                    </tr>
                    </thead>
                    @foreach($posts as $post)
                        <tbody>
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->post_name}}</td>
                                <td>
                                    <img width="100px" src="{{$post->post_img}}"/>
                                </td>
                                <td>{{$post->category_id }}</td>
                                <td>
                                    <input type="checkbox" {{$post->post_display == 1 ? 'checked' : ''}}>
                                </td>
                                <td>
                                    <input type="checkbox" {{$post->post_outstanding == 1 ? 'checked' : ''}}>
                                </td>
                                <td>{{$post->created_at}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('post.update',['id'=>$post->id])}}">
                                        <i class="fas fa-pencil-alt"></i>Sửa
                                    </a>
                                    <a class="btn btn-danger btn-action-delete"
                                        data-url="{{route('post.delete',['id'=>$post->id])}}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Xóa
                                    </a>
                                </td>
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
<script
type="module"
src="{{Vite::asset('resources/js/components/confirmDel.js')}}"
></script>
@endpush
