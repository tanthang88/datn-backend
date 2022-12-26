@extends('layout/masterLayout')
@section('title')
    {{$title}}
@endsection
@push('styles')
@endpush
<style>
    th{
        font-size:14px;
    }
    td, td a{
        text-align:center;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="row" style="padding-top:15px;padding-bottom:15px;">
                    <div class="col-2">
                        <button type="button" class="btn btn-success"><a href="{{route('about.add')}}" style="color:#fff">+ Thêm mới</a></button>
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
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:5.5%;text-align:center;">ID</th>
                        <th style="width:20%; text-align:center;">Tên thông tin</th>
                        <th style="width:6.5%;text-align:center;">Phân loại</th>
                        <th style="width:6%;text-align:center;" >Ẩn/hiện</th>
                        <th style="width:20%; text-align:center;">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $about)
                            <tr>
                                <td>{{$about->id}}</td>
                                <td>{{$about->about_name}}</td>
                                <td>{{$about->type}}</td>
                                <td>
                                    @if($about->about_display == 1)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-danger">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="hidden" id="id" value="{{$about->id}}">
                                    <a class="btn btn-info btn-sm" href="/about/update/{{$about->id}}">
                                        <i class="fas fa-pencil-alt"></i>Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-action-delete" data-url="/about/delete/{{$about->id}}">
                                        <i class="fas fa-trash"></i>Xóa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr/>
                {{$data->links()}}
              </div>
            </div>

        </div>
@endsection
<script
    type="module"
    src="{{Vite::asset('resources/js/components/confirmDel.js')}}"
></script>
