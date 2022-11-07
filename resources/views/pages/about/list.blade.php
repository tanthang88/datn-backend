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
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-12">
                <div class="row">
                    <div class="col-2">
                        <button type="button" class="btn btn-dark"><a href="about/add" style="color:#fff">Thêm</a></button>
                        <button type="button" class="btn btn-warning">Xóa Chọn</button>
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
                        @foreach ($data as $data)
                            <tr>
                                <td></td>
                                <td>{{$data->about_order}}</td>
                                <td>{{$data->about_name}}</td>
                                <td>{{$data->type}}</td>
                                <td>{{$data->created_at}}</td>
                                <td>
                                    @if($data->about_display == 1)
                                        <input type="checkbox" checked>
                                    @else
                                        <input type="checkbox" >
                                    @endif
                                </td>
                                <td>
                                    <input type="hidden" id="id" value="{{$data->id}}">
                                    <a class="btn btn-info btn-sm" href="/about/update/{{$data->id}}">
                                        <i class="fas fa-pencil-alt"></i>Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" id="btn_delete" onclick="Del({{$data->id}})">
                                        <i class="fas fa-trash"></i>Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <hr/>
                    {{-- {{$data->links()}} --}}
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    <!-- /.content -->
</div>
@endsection
<script>
    function Del(id)
    {
        swal({
            title: "Bạn có chắc không?",
            text: "Sau khi bị xóa, bạn sẽ không thể khôi phục thông tin này!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/about/delete/"+id+"",
                swal("Thông tin của bạn đã bị xóa. ", {
                title: "Đã xóa",
                icon: "success",
                });
            } else {
                swal("Thông tin của bạn an toàn!",{
                    title: "Đã hủy",
                    icon: "error",
                });
            }
            });
    }
</script>
