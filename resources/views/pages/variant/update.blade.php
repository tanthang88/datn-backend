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
        box-shadow: 0px 1px 2px rgb(16 24 40 / 10%);
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
                            <button type="button" class="btn btn-warning"><a href="{{route('product.list')}}" style="color:black"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Thoát</a></button>
                        </div>
                    </div>

                    <div class="card" style="border-top:1px solid rgba(0,0,0,.125);">
                        <ul class="nav nav-pills">
                            <li class="nav-content pd-row" style="border-right:1px solid rgba(0,0,0,.125);"><i class="fa fa-certificate" aria-hidden="true"></i></li>
                            <li class="nav-content pd-row">Dữ liệu biến thể ---</li>
                            <li class="nav-content">
                                <a class="btn btn-primary" style="color:#2271b1;border-color: #2271b1;background: #f6f7f7;" onclick="addVariant()">Thêm biến thể </a>
                            </li>
                        </ul>
                        <div style="border-top:1px solid rgba(0,0,0,.125)">
                        </div>
                        <div class="card-body" style="padding:0;">
                            <div class="row">
                                <div class="col-7 col-sm-12" style="padding:0.75rem;">
                                    <div id="last-content-variant">
                                        <?php echo $html ?>
                                    </div>
                                    <div id="new-content-variant">
                                        <input type="hidden" id="input-variant" name="input_variant">
                                        <div id="vert-tabs-content-variant">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
              </form>
            </div>
                <!-- ./col -->
                <div class="card bg-gradient" style="color:#111111;border-left-width:4px;border-left-color:#28a745;background-color:#f6f7f7;display:none" id="add-variant">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;   ">
                        <div class="card-title row" style="display:flex;width:80%;">
                            <?php echo $html_n ?>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <input type="hidden" name="count_n" value="{{$count}}">
                        <div class="row pd-10">
                            <label class="col-3">Giá:</label>
                            <input type="text" name="price_n[]" class="col-7 form-control" id=""  placeholder="Giá sản phẩm" required>
                        </div>
                        <div class="row pd-10"><label class="col-3">Hình ảnh:</label>
                            <input type="file" name="image_n[]" class="col-7 form-control" id="image" onchange="ImagesFileAsURL()" required>
                            <div class="col-3"></div>
                            <div class="col-7" id="displayImg">

                            </div>
                        </div>
                    </div>
                </div>
        </div><!-- /.container-fluid -->

    <!-- /.content -->
</div>
@endsection
@push('scripts')
<script>
    $('.removeVariant').click(function(){
        let urlRequest = $(this).data('url');
        let that = $(this);
        if(confirm('Bạn có chắc muốn xóa mục này không ?')){
            $.ajax({
                type:'GET',
                datatype:'JSON',
                url: urlRequest ,
                success: function (){
                    that.parent().parent().parent().remove();
                }
            })
        }
    })

    // nút thêm biến thể
    function addVariant(){
        $("#add-variant").clone().appendTo("#vert-tabs-content-variant");
        $("#add-variant").show();
        $('#input-variant').val('check');
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
@endpush
