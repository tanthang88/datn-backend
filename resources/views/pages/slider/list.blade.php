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
        <div class="container-fluid">
            <div class="row" style="padding-top:15px;padding-bottom:15px;">
                <div class="col-2">
                    <button type="button" class="btn btn-success"><a href="{{route('slider.add')}}" style="color:#fff">+ Thêm mới</a></button>
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
                    @foreach($sliders as $slider)
                        <tbody>
                            <tr>
                                <td>{{$slider->id}}</td>
                                <td>
                                    @if ($slider->image!=null)
                                        <img width="100px" src="{{$slider->image}}"/>
                                    @else
                                        Trống
                                    @endif
                                </td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider?->link}}</td>
                                <td>
                                    @if($slider->display==1)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-danger">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{route('slider.show',['slider'=>$slider->id])}}">
                                        <i class="fas fa-pencil-alt"></i>Sửa
                                    </a>
                                    <a class="btn btn-sm btn-danger btn-action-delete"
                                        data-url="{{route('slider.delete',['id'=>$slider->id])}}">
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
                    {{$sliders->links();}}
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
