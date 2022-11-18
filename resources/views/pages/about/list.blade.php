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
                <div class="row" style="padding-top:10px;">
                    <div class="col-2">
                        <button type="button" class="btn btn-dark"><a href="{{route('about.add')}}" style="color:#fff">Thêm mới</a></button>
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
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:3%"><input type="checkbox" style="text-align:center;"></th>
                        <th style="width:5.5%">Thứ tự</th>
                        <th style="width:20%; text-align:center;">Tên thông tin</th>
                        <th style="width:6.5%">Phân loại</th>
                        <th style="width:10%">Ngày tạo</th>
                        <th style="width:6%" >Ẩn/hiện</th>
                        <th style="width:20%; text-align:center;">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $about)
                            <tr>
                                <td></td>
                                <td>{{$about->about_order}}</td>
                                <td>{{$about->about_name}}</td>
                                <td>{{$about->type}}</td>
                                <td>{{$about->created_at}}</td>
                                <td>
                                    @if($about->about_display == 1)
                                        <input type="checkbox" checked>
                                    @else
                                        <input type="checkbox" >
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
