@extends('layout/masterLayout')
@section('title')
Banner
@endsection
@push('style')
<style>
     th {
            font-size: 14px;
        }
</style>
@endpush
@section('content')
    <!-- Main content -->
        <div class="container-fluid">
            <div class="row" style="padding-top:15px;padding-bottom:15px;">
                <div class="col-2">
                    <button type="button" class="btn btn-success"><a href="{{route('banner.add')}}" style="color:#fff">+ Thêm mới</a></button>
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
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th style="width:35%;">Tiêu đề</th>
                        <th style="width:20%;">Đường liên kết</th>
                        <th>Hiển Thị</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    @foreach($banners as $banner)
                        <tbody>
                            <tr>
                                <td>{{$banner->id}}</td>
                                <td>
                                    @if ($banner->image!=null)
                                        <img width="100px" src="{{$banner->image}}"/>
                                    @else
                                        Trống
                                    @endif
                                </td>
                                <td>{{$banner->title}}</td>
                                <td>{{$banner?->link}}</td>
                                <td>
                                    <input type="checkbox" {{$banner->display==1 ? "checked" : "" }} >
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{route('banner.show',['banner'=>$banner->id])}}">
                                        <i class="fas fa-pencil-alt"></i>Sửa
                                    </a>
                                    <a class="btn btn-sm btn-danger btn-action-delete"
                                        data-url="{{route('banner.delete',['id'=>$banner->id])}}">
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

</div>
@endsection
@push('scripts')
<script
type="module"
src="{{Vite::asset('resources/js/components/confirmDel.js')}}"
></script>
@endpush
