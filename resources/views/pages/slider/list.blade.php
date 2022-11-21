@extends('layout/masterLayout')
@section('title')
Slider
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
              <div class="col-12">Danh sách slider</div>
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
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Hình ảnh</th>
                    <th>Đường liên kết</th>
                    <th>Hiển Thị</th>
                    <th>Mô tả</th>
                    </tr>
                    </thead>
                    @foreach($sliders as $sliders)
                        <tbody>
                            <tr>
                                <td>{{$sliders->id}}</td>
                                <td>{{$sliders->order}}</td>
                                <td>{{$sliders->title}}</td>
                                <td>
                                    <img width="100px" src="{{$sliders->image}}"/>
                                </td>
                                <td>{{$sliders->link}}</td> 

                                <td>
                                    @if($sliders->display == 0)
                                    {{'Không'}}
                                    @else
                                    {{'Có'}}
                                    @endif
                                </td>
                                <td>{{$sliders->desc}}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href={{route('slider.show', ['slider' => $sliders->id])}}>Sửa</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href={{route('slider.delete', ['id' => $sliders->id])}}> Xóa</a></td>       
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
