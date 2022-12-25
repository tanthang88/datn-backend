@extends('layout/masterLayout')
@section('title')
{{$title}}
@endsection
@push('style')
<style>
 th {
            font-size: 14px;
        }
</style>
@endpush
@section('content')
<!-- Content Header (Page header) -->

<!-- Main content -->
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row" style="padding-top:15px;padding-bottom:15px;">
        <div class="col-2">
            <button type="button" class="btn btn-success"><a href="{{route('postCategory.add')}}" style="color:#fff">+ Thêm mới</a></button>
        </div>
        <div class="col-7"></div>
        <form action="" class="col-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">
                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <!-- Main row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên bài viết</th>
                        <th>Hiển Thị</th>
                        <th style="text-align:center">Nổi bật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @foreach($post_categories as $post_category)
                <tbody>
                    <tr>
                        <td>{{$post_category->id}}</td>
                        <td>{{$post_category->category_name}}</td>
                        <td>
                            @if ($post_category->category_display == 1)
                                <span class="badge badge-success">Hiển thị</span>
                            @else
                                <span class="badge badge-danger">Ẩn</span>
                            @endif
                        </td>
                        <td style="text-align:center">
                            @if($post_category->category_outstanding == 1)
                                <i class="fa fa-star" aria-hidden="true"></i>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info"
                                href="{{route('postCategory.update',['id'=>$post_category->id])}}">
                                <i class="fas fa-pencil-alt"></i>Sửa
                            </a>
                            <a class="btn btn-sm btn-danger btn-action-delete"
                                data-url="{{route('postCategory.delete',['id'=>$post_category->id])}}">
                                <i class="fas fa-trash">
                                </i>
                                Xóa
                            </a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <hr/>
            {{$post_categories->links()}}
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
<script type="module" src="{{Vite::asset('resources/js/components/confirmDel.js')}}"></script>
@endpush
