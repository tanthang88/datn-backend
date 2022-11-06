@extends('layout/masterLayout')
@section('title')
    {{$title}}
@endsection
@push('style')
<style>
    .nav-content{
        color:rgba(0,0,0,.6);
        padding:0.5rem 0.7rem;
        font-weight:bold;
    }
    .pd-row{
        margin:auto 0;
    }
    .pd-row-2{
        margin-left:-7.5px;
        margin-right:-7.5px;
    }
    .pd-10{
        padding:10px 0;
    }
    span.help-block{
        color:#dc3545;
    }
    #displayImg {
        margin-top: 30px;
    }
    #displayImg img{
        width:100px;
        height:80px;
        margin-right: 15px;
    }
    .card-title select{
        margin:.25em .25em .25em 0;
    }
    .form-control{
        border:1px solid #111111;
    }
</style>
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <form action="" method="post" class="col-12" enctype="multipart/form-data">
                    <div class="row" style="padding-bottom:20px;">
                        <div class="col-3">
                            <button type="submit" class="btn btn-info"><i class="fa fa-check-circle" aria-hidden="true" style="padding-right:3px;"></i>Hoàn tất</button>
                            <button type="button" class="btn btn-warning"><a href="Product/Add" style="color:black"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Thoát</a></button>
                        </div>
                        @include('components.alert')
                    </div>

                    <div class="card" style="border-top:1px solid rgba(0,0,0,.125);">
                        <ul class="nav nav-pills">
                            <li class="nav-content pd-row" style="border-right:1px solid rgba(0,0,0,.125);"><i class="fa fa-certificate" aria-hidden="true"></i></li>
                            <li class="nav-content pd-row">Dữ liệu biến thể ---</li>
                            <li class="nav-content">
                                <a class="btn btn-primary" style="color:#2271b1;border-color: #2271b1;background: #f6f7f7;" onclick="addProperties()">Thêm biến thể </a>
                            </li>
                        </ul>
                        <div style="border-top:1px solid rgba(0,0,0,.125)">
                        </div>
                        <div class="card-body" style="padding:0;">
                            <div class="row">
                                <div class="col-7 col-sm-12" style="padding:0.75rem;">
                                    <div id="vert-tabs-content-properties"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
              </form>
                    <?php echo $html ?>
            </div>
                <!-- ./col -->

        </div><!-- /.container-fluid -->

    <!-- /.content -->
</div>
@endsection
<script>
    // nút thêm thuộc tính
    function addProperties(){
        $("#add-properties").clone().appendTo("#vert-tabs-content-properties");
        $("#add-properties").show();
    }
    // hình ảnh sản phẩm
    function ImagesFileAsURL() {
               var fileSelected = document.getElementById('image').files;
               if (fileSelected.length > 0) {
                       var fileToLoad = fileSelected[0];
                       var fileReader = new FileReader();
                       fileReader.onload = function(fileLoaderEvent) {
                           var srcData = fileLoaderEvent.target.result;
                           var newImage = document.createElement('img');
                           newImage.src = srcData;
                           document.getElementById('displayImg').innerHTML = newImage.outerHTML;
                       }
                       fileReader.readAsDataURL(fileToLoad);

               }
    }
</script>
