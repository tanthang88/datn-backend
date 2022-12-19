@extends('layout/masterLayout')
@section('title')
{{$title}}
@endsection
@push('style')
<style>
       #img_priv img{
        width:200px;
        padding-top:10px;
    }
</style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <div class="card card-primary row">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{csrf_field() }}
                            <div class="row" style="padding-bottom:20px;">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check" aria-hidden="true" style="padding-right:3px;"></i>Hoàn tất</button>
                                    <button type="button" class="btn btn-warning"><a href="{{route('supplier.list')}}" style="color:black"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Supplier">Nhà cung cấp</label>
                                <input type="text" name="supplier_name" id="supplier_name" class="form-control @error('supplier_name') is-invalid @enderror" value="{{old('supplier_name')}}"  placeholder="Nhập nhà cung cấp">
                                @error('supplier_name')
                                <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Supplier">Logo nhà cung cấp</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="post_img" name="supplier_photo"  onchange="img_priv()">
                                    <label class="custom-file-label" for="supplier_photo">Choose file</label>
                                </div>
                                <div class="preview-upload" id="img_priv">

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Địa chỉ </label>
                                    <input type="text" name="supplier_address" id="supplier_address" class="form-control @error('supplier_address') is-invalid @enderror" value="{{old('supplier_address')}}"  placeholder="Nhập địa chỉ nhà cung cấp">
                                    @error('supplier_address')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Google Map</label>
                                    <input type="text" name="supplier_map" class="form-control" value="{{old('supplier_map')}}"  placeholder="Nhập iframe ggmap">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="Supplier">Điện thoại</label>
                                    <input type="number" name="supplier_phone" id="supplier_phone" class="form-control @error('supplier_phone') is-invalid @enderror" value="{{old('supplier_phone')}}"  placeholder="Nhập số điện thoại nhà cung cấp">
                                    @error('supplier_phone')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="Supplier">Email</label>
                                    <input type="email" name="supplier_email" id="supplier_email" class="form-control @error('supplier_email') is-invalid @enderror" value="{{old('supplier_email')}}"  placeholder="Nhập email điện thoại nhà cung cấp">
                                    @error('supplier_email')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Supplier">Hiển thị</label>
                                <input style="margin-left:17px" type="checkbox" name="supplier_display" checked>
                            </div>
                            <div class="form-group">
                                <label for="Supplier">Nổi bật</label>
                                <input style="margin-left:17px" type="checkbox" name="supplier_outstanding">
                            </div>
                            <div class="form-group">
                                <label>Mô Tả </label>
                                <textarea name="supplier_desc" id="pro_content" class="form-control">{{old('supplier_desc')}}</textarea>
                            </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->

</div>
@endsection
@push('scripts')
<script>
    function img_priv() {
   var fileSelected = document.getElementById('post_img').files;
   if (fileSelected.length > 0) {
           var fileToLoad = fileSelected[0];
           var fileReader = new FileReader();
           fileReader.onload = function(fileLoaderEvent) {
               var srcData = fileLoaderEvent.target.result;
               var newImage = document.createElement('img');
               newImage.src = srcData;
                       document.getElementById('img_priv').innerHTML = newImage.outerHTML;
                   }
                   fileReader.readAsDataURL(fileToLoad);

           }
   }
</script>
@endpush
@section('footer')
@endsection
