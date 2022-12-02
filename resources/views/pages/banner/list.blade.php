@extends('layout/masterLayout')
@section('title')
Banner
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
              <div class="col-12">Danh sách Banner</div>
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
                    <th>Tiêu đề</th>
                    <th>Hình ảnh</th>
                    <th>Đường liên kết</th>
                    <th>Hiển Thị</th>
                    <th>Sửa</th>
                    <th>Xoá</th>
                    </tr>
                    </thead>
                    @foreach($banners as $banners)
                        <tbody>
                            <tr>
                                <td>{{$banners->id}}</td>
                                <td>{{$banners->title}}</td>
                                <td>
                                    <img width="100px" src="{{$banners->image}}"/>
                                </td>
                                <td>{{$banners->link}}</td>

                                <td>
                                    @if($banners->display == 0)
                                    {{'Không'}}
                                    @else
                                    {{'Có'}}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href={{route('banner.show', ['banner' => $banners->id])}}>Sửa</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href={{route('banner.delete', ['id' => $banners->id])}}> Xóa</a></td>
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
