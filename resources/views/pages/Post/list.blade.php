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
            <div class="row">
              <div class="col-12">Danh sách bài viết</div>
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
                    <th>Thuộc danh mục</th>
                    <th>Tiêu đề bài viết</th>
                    <th>Hình ảnh</th>
                    <th>Hiển Thị</th>
                    <th>Nổi bật</th>
                    <th>Mô tả ngắn</th>                      
                    <th>Ngày Tạo</th>
                    </tr>
                    </thead>
                    @foreach($posts as $posts)
                        <tbody>
                            <tr>
                                <td>{{$posts->id}}</td>
                                <td>{{$posts->category_id}}</td>
                                <td>{{$posts->post_name}}</td> 
                                <td>
                                    <img width="100px" src="{{$posts->post_img}}"/>
                                    </td>                
                                <td>
                                    @if($posts->post_display == 0)
                                    {{'Không'}}
                                    @else
                                    {{'Có'}}
                                    @endif
                                </td>
                                
                                <td>
                                    @if($posts->post_outstanding == 0)
                                    {{'Không'}}
                                    @else
                                    {{'Có'}}
                                    @endif
                                </td>
                                <td>{{$posts->post_desc}}</td>
                              
                                <td>{{$posts->created_at}}</td>   
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="Post/Update/{{$posts->id}}">Sửa</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="Post/Delete/{{$posts->id}}"> Xóa</a></td>       
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
