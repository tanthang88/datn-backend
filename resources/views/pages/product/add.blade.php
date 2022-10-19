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
    .row label{
        padding: 0.375rem 0.75rem;
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
    #displayListImg {
        margin-top: 30px;
    }

    #displayListImg img {
        height: 50px;
        margin-right: 15px;
        display: inline-block;
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
                    <div class="card" style="border-top:1px solid rgba(0,0,0,.125)">
                        <ul class="nav nav-pills">
                            <li class="nav-content" style="border-right:1px solid rgba(0,0,0,.125);"><i class="fa fa-certificate" aria-hidden="true"></i></li>
                            <li class="nav-content">Tổng quát</li>
                        </ul>
                        <div class="card-header p-2" style="border-top:1px solid rgba(0,0,0,.125)">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#infomation" data-toggle="tab">Thông tin chung</a></li>
                                <li style="margin-left:10px;"></li>
                                <li class="nav-item"><a class="nav-link" href="#content" data-toggle="tab">Nội dung</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="infomation">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row pd-10">
                                                <label class="col-4">Tên sản phẩm</label>
                                                <input type="text" name="product_name" class="col-8 form-control" id="" value="{{ old('product_name')}}" placeholder="Tên sản phẩm">
                                                @error('product_name')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Nhà cung cấp</label>
                                                <select class="col-8 form-control select2 select2-hidden-accessible" name="supplier_id" style="width: 80%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option selected="selected" data-select2-id="1">Nhà cung cấp</option>
                                                    @foreach($supplier as $supplier )
                                                        <option value="{{ $supplier->id }}">{{$supplier->supplier_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Giá sản phẩm (₫)</label>
                                                <input type="number" name="product_price" class="col-8 form-control" id="" value="{{ old('product_price')}}" placeholder="Giá">
                                                @error('product_price')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Số lượng kho</label>
                                                <input type="number" name="product_quantity" class="col-8 form-control" id="" value="{{ old('product_quantity')}}" placeholder="Số lượng nhập về">
                                                @error('product_quantity')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Nổi bật</label>
                                                <input type="checkbox" name="product_outstanding">
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Hiển thị</label>
                                                <input type="checkbox" name="product_display">
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Số thứ tự</label>
                                                <input type="number" name="product_order" class="col-8 form-control" id="" value="{{ old('product_order')}}" placeholder="Thứ tự">
                                                @error('product_order')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6" style="padding:0 50px;">
                                            <div class="row pd-10">
                                                <label class="col-4">Lựa chọn danh mục</label>
                                                <select class="col-8 form-control select2 select2-hidden-accessible" name="category_id" style="width: 80%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option selected="selected" data-select2-id="1">Danh mục</option>
                                                    <?php  $categories;
                                                        $parent_id = 0;
                                                        $char = '';
                                                        foreach ($categories as $key => $category){
                                                            if($category->parent_id == 0){
                                                                $html = '
                                                                <option value=" '.$category->id.' "> '. $char .$category->category_name.'</option>
                                                                ';
                                                            unset($category[$key]);
                                                            }else{
                                                                $html = '
                                                                <option value=" '.$category->id.' "> '. '---' .$category->category_name.'</option>
                                                                ';
                                                            }
                                                            echo $html;
                                                        }
                                                        ?>


                                                </select>
                                            </div>
                                            {{-- <div class="form-group pd-row-2">
                                                <label for="exampleInputFile">Ảnh sản phẩm:(Độ dài 600x600px)</label>
                                                <div class="input-group">
                                                    <input type="text" id="image" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-folder-open" aria-hidden="true"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="form-group pd-row-2">
                                                <label for="exampleInputFile">Ảnh sản phẩm:(Độ dài 600x600px)</label>
                                                <div class="input-group">
                                                    <input type="file" name="upload[]" id="upload" value="{{old('upload[]')}}" onchange="ImagesFileAsURL()" multiple />
                                                    <div id="displayImg">

                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="form-group pd-row-2">
                                                <label for="exampleInputFile">Ảnh sản phẩm:(Độ dài 600x600px)</label>
                                                <div class="input-group">
                                                    <input id="img_product" type="file" name="img_product[]" onchange="ImagesFileAsURL()">
                                                    <div id="displayImg">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pd-row-2">
                                                <label for="exampleInputFile">Ảnh sản phẩm:(Độ dài 600x600px)</label>
                                                <div class="input-group">
                                                    <input id="img_list" type="file" name="img_list[]" onchange="ImagesListFileAsURL()" multiple>
                                                    <div id="displayListImg">

                                                    </div>
                                                </div>
                                            </div>


                                    </div>
                                </div>

                                <div class="tab-pane" id="content">
                                    <div class="row pd-10">
                                        <label class="col-2">Mô tả</label>
                                        <textarea class="col-10 form-control" name="description" rows="3" placeholder="Bạn bắt buộc phải nhập phần mô tả để SEO tốt hơn"></textarea>
                                        <p class="col-2"></p>
                                        <p class="col-10" style="padding-left:0;padding-top:10px;font-weight:bold">(Tốt nhất là 250 - 300 ký tự) <strong style="color:red;">- Chú ý: Bạn phải nhập phần mô tả để có kết quả SEO tốt nhất trên Google</strong></p>
                                        </select>
                                    </div>
                                    <div class="form-group pd-10" style="margin-left:-7.5px; margin-right:-7.5px;">
                                        <label>Nội dung</label>
                                        <textarea class="col-10 form-control" name="content" id="pro_content" rows="3"></textarea>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card" style="border-top:1px solid rgba(0,0,0,.125)">
                        <ul class="nav nav-pills">
                            <li class="nav-content" style="border-right:1px solid rgba(0,0,0,.125);"><i class="fa fa-barcode" aria-hidden="true"></i></li>
                            <li class="nav-content">Thông số kỹ thuật</li>
                        </ul>
                        <div style="border-top:1px solid rgba(0,0,0,.125)">
                        </div>
                        <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row pd-10">
                                                <label class="col-4">Màn hình</label>
                                                <input type="text" name="config_screen" value="{{old('config_screen')}}" class="col-8 form-control" id="" placeholder="Màn hình">
                                                @error('config_screen')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">CPU</label>
                                                <input type="text" name="config_cpu" value="{{old('config_cpu')}}" class="col-8 form-control" id="" placeholder="CPU">
                                                @error('config_cpu')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Ram</label>
                                                <input type="text" name="config_ram" value="{{old('config_ram')}}" class="col-8 form-control" id="" placeholder="Ram">
                                                @error('config_ram')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Camera sau</label>
                                                <input type="text" name="config_camera" value="{{old('config_camera')}}" class="col-8 form-control" id="" placeholder="Camera sau">
                                                @error('config_camera')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6" style="padding:0 50px;">
                                            <div class="row pd-10">
                                                <label class="col-4">Camera trước</label>
                                                <input type="text" name="config_selfie" value="{{old('config_selfie')}}" class="col-8 form-control" id="" placeholder="Camera trước">
                                                @error('config_selfie')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Thẻ nhớ ngoài</label>
                                                <input type="text" name="config_battery" value="{{old('config_battery')}}" class="col-8 form-control" id="" placeholder="Thẻ nhớ ngoài">
                                                @error('config_battery')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Hệ điều hành</label>
                                                <input type="text" name="config_system" value="{{old('config_system')}}" class="col-8 form-control" id="" placeholder="Hệ điều hành">
                                                @error('config_system')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <div class="card" style="border-top:1px solid rgba(0,0,0,.125)">
                        <div class="row" style="margin-left:3px;">
                            <ul class="nav nav-pills col-4">
                                <li class="nav-content pd-row" style="border-right:1px solid rgba(0,0,0,.125);"><i class="fa fa-certificate" aria-hidden="true"></i></li>
                                <li class="nav-content pd-row">Nội dung SEO</li>
                            </ul>
                            <ul class="nav nav-pills col-8">
                                <li class="nav-content pd-row">SEO Google được chuyên gia Đà Nẵng update vào ngày: 02/07/2022</i></li>
                                <li class="nav-content"><button type="button" class="btn btn-success">Xem hướng dẫn</button></li>
                            </ul>
                        </div>
                        <div style="border-top:1px solid rgba(0,0,0,.125)"></div>
                        <div class="card-body">
                            <div class="tab-content">
                                        <div class="row pd-10">
                                            <label class="col-2">Title</label>
                                            <div class="input-group mb-3 col-10">
                                                <input type="text" class="form-control" value="{{ old('seo_title')}}"  name="seo_title" placeholder="Nội dung thẻ meta Title dùng để SEO" aria-describedby="basic-addon1">
                                                <span class="input-group-text" id="basic-addon1">70</span>
                                            </div>
                                        </div>
                                        <div class="row pd-10">
                                            <label class="col-2">Description</label>
                                            <div class="input-group mb-3 col-10">
                                                <input type="text" class="form-control" value="{{ old('seo_description')}}"  name="seo_description" placeholder="Từ khóa chính cho bài viết" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="row pd-10">
                                            <label class="col-2">Từ khóa</label>
                                            <div class="input-group mb-3 col-10">
                                                <input type="text" class="form-control" value="{{ old('seo_keywords')}}"  name="seo_keywords" placeholder="Nội dung thẻ meta Description dùng để SEO" aria-describedby="basic-addon1">
                                                <span class="input-group-text" id="basic-addon1">156</span>
                                            </div>
                                        </div>
                            </div>

                        </div>

                    </div>
                    @csrf
              </form>
            </div>
                <!-- ./col -->

        </div><!-- /.container-fluid -->

    <!-- /.content -->
    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width:95% !important;margin: 1.75rem auto;" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <iframe src="/laravel-filemanager?type=image" style="width:100%; height:500px; overflow:hidden;border:none"></iframe>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>
</div>
@endsection
<script>
    // hình ảnh sản phẩm
    $("#img_product").fileinput({
      theme: 'fas',
      showUpload: false,
      showCaption: false,
      browseClass: "btn btn-primary btn-lg",
      fileType: "any",
      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
      overwriteInitial: false,
      allowedFileExtensions: ["jpg", "gif", "png", "txt"]
    });
    function ImagesFileAsURL() {
               var fileSelected = document.getElementById('img_product').files;
               if (fileSelected.length > 0) {
                   for (var i = 0; i < fileSelected.length; i++) {
                       var fileToLoad = fileSelected[i];
                       var fileReader = new FileReader();
                       fileReader.onload = function(fileLoaderEvent) {
                           var srcData = fileLoaderEvent.target.result;
                           var newImage = document.createElement('img');
                           newImage.src = srcData;
                           document.getElementById('displayImg').innerHTML += newImage.outerHTML;
                       }
                       fileReader.readAsDataURL(fileToLoad);
                   }

               }
    }
    // list hình ảnh
    $("#img_list").fileinput({
      theme: 'fas',
      showUpload: false,
      showCaption: false,
      browseClass: "btn btn-primary btn-lg",
      fileType: "any",
      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
      overwriteInitial: false,
      allowedFileExtensions: ["jpg", "gif", "png", "txt"]
    });
    function ImagesListFileAsURL() {
               var fileSelected = document.getElementById('img_list').files;
               if (fileSelected.length > 0) {
                   for (var i = 0; i < fileSelected.length; i++) {
                       var fileToLoad = fileSelected[i];
                       var fileReader = new FileReader();
                       fileReader.onload = function(fileLoaderEvent) {
                           var srcData = fileLoaderEvent.target.result;
                           var newImage = document.createElement('img');
                           newImage.src = srcData;
                           document.getElementById('displayListImg').innerHTML += newImage.outerHTML;
                       }
                       fileReader.readAsDataURL(fileToLoad);
                   }

               }
    }
</script>
