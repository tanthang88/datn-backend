@extends('layout/masterLayout')
@section('title')
    {{ $title }}
@endsection
@push('style')
    <style>
        .nav-content {
            color: rgba(0, 0, 0, .6);
            padding: 0.5rem 0.7rem;
            font-weight: bold;
        }

        .row label {
            padding: 0.375rem 0.75rem;
        }

        .pd-row {
            margin: auto 0;
        }

        .pd-row-2 {
            margin-left: -7.5px;
            margin-right: -7.5px;
        }

        .pd-10 {
            padding: 10px 0;
        }

        span.help-block {
            color: #dc3545;
        }

        #displayListImg,
        #displayImg,
        #imgNow,
        #imgListNow {
            margin-top: 30px;
        }

        #displayImg img,
        #imgNow img {
            height: 180px;
            margin-right: 15px;
        }

        #displayListImg img,
        #imgListNow img {
            height: 50px;
            margin-right: 15px;
            display: inline-block;
        }

        .hide {
            display: none;
        }

        .form-control {
            box-shadow: 0px 1px 2px rgb(16 24 40 / 10%);
        }
    </style>
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card card-primary row">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
                @if ($data->updated_at != '')
                    <h3 class="card-title" style="float:right;">Cập nhật vào: {{ $data->updated_at }}</h3>
                @elseif ($data->created_at != '')
                    <h3 class="card-title" style="float:right;">Thêm mới vào: {{ $data->created_at }}</h3>
                @else
                @endif
            </div>
            <div class="card-body">
                <form action="" method="post" class="col-12" enctype="multipart/form-data">
                    <div class="row" style="padding-bottom:20px;">
                        <div class="col-3">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check" aria-hidden="true"
                                    style="padding-right:3px;"></i>Hoàn tất</button>
                            <button type="button" class="btn btn-warning"><a href="{{ route('product.list') }}"
                                    style="color:black"><i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                    Thoát</a></button>
                        </div>
                    </div>
                    <div class="card" style="border-top:1px solid rgba(0,0,0,.125)">
                        <ul class="nav nav-pills">
                            <li class="nav-content" style="border-right:1px solid rgba(0,0,0,.125);"><i
                                    class="fa fa-certificate" aria-hidden="true"></i></li>
                            <li class="nav-content">Tổng quát</li>
                        </ul>
                        <div class="card-header p-2" style="border-top:1px solid rgba(0,0,0,.125)">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#infomation" data-toggle="tab">Thông
                                        tin chung</a></li>
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
                                                <label class="col-4" for="product_name">Tên sản phẩm</label>
                                                <input type="text" name="product_name"
                                                    class="col-8 form-control @error('product_name') is-invalid @enderror"
                                                    id="product_name" value="{{ $data->product_name }}"
                                                    placeholder="Tên sản phẩm">
                                                @error('product_name')
                                                    <span class="col-4"></span>
                                                    <small class="error-form col-8" style="color: red;font-style: italic">
                                                        {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4" for="supplier_id">Nhà cung cấp</label>
                                                <select
                                                    class="col-8 form-control select2 @error('supplier_id') is-invalid @enderror"
                                                    name="supplier_id" style="width: 80%;" data-select2-id="1"
                                                    tabindex="-1" aria-hidden="true">
                                                    <option selected="selected" data-select2-id="1" disabled>Nhà cung cấp
                                                    </option>
                                                    @foreach ($supplier as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            {{ $supplier->id == $data->supplier_id ? 'selected' : '' }}>
                                                            {{ $supplier->supplier_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('supplier_id')
                                                    <span class="col-4"></span>
                                                    <small class="error-form col-8" style="color: red;font-style: italic">
                                                        {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4" for="product_quantity">Số lượng kho</label>
                                                <input type="number" name="product_quantity"
                                                    class="col-8 form-control @error('product_quantity') is-invalid @enderror"
                                                    id="product_quantity" value="{{ $data->product_quantity }}"
                                                    placeholder="Số lượng nhập về">
                                                @error('product_quantity')
                                                    <span class="col-4"></span>
                                                    <small class="error-form col-8" style="color: red;font-style: italic">
                                                        {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Nổi bật</label>
                                                <input type="checkbox" value="on"
                                                    {{ $data->product_outstanding == '1' ? 'checked' : '' }}
                                                    name="product_outstanding">
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Hiển thị</label>
                                                <input type="checkbox" {{ $data->product_display == '1' ? 'checked' : '' }}
                                                    name="product_display">
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Thông số kỹ thuật</label>
                                                <input type="checkbox" {{ $configuration != null ? 'checked' : '' }}
                                                    id="is_configuration_product" name="is_configuration_product"
                                                    onclick="chooseConfiguration()">
                                            </div>
                                        </div>
                                        <div class="col-6" style="padding:0 50px;">
                                            <div class="row pd-10">
                                                <label class="col-4">Chọn danh mục</label>
                                                <select class="col-8 form-control select2" name="category_id"
                                                    style="width: 80%;" data-select2-id="1" tabindex="-1"
                                                    aria-hidden="true">
                                                    <option selected="selected" data-select2-id="1" disabled>Chọn danh mục
                                                    </option>
                                                    <?php $category_id = $data->category_id; ?>
                                                    {!! \App\Helper\Product_Helper::product_category_update($categories, $category_id) !!}
                                                </select>
                                                @error('category_id')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group pd-row-2">
                                                <label for="exampleInputFile">Hình ảnh sản phẩm:</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="img_product"
                                                        name="img_product" onchange="ImagesFileAsURL()">
                                                    <label class="custom-file-label" for="img_product">Choose file</label>
                                                </div>
                                                <div id="imgNow">
                                                    @if ($data->product_image != '')
                                                        <img src="{{ $data->product_image }}">
                                                    @endif
                                                </div>
                                                <div id="displayImg">
                                                    {{-- Hiện thị hình ảnh mới --}}
                                                </div>
                                            </div>
                                            <div class="form-group pd-row-2">
                                                <label for="exampleInputFile">Album ảnh:</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="img_list"
                                                        name="img_list[]" onchange="ImagesListFileAsURL()" multiple>
                                                    <label class="custom-file-label" for="img_list">Choose file</label>
                                                </div>
                                                <div id="imgListNow">
                                                    @if ($images != null)
                                                        @foreach ($images as $images)
                                                            <img src="{{ $images->image }}">
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div id="displayListImg">
                                                    {{-- Hiện thị hình ảnh mới --}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="content">
                                    <div class="row pd-10">
                                        <label class="col-2">Mô tả</label>
                                        <textarea class="col-12 form-control" name="product_desc" rows="3"
                                            placeholder="Bạn bắt buộc phải nhập phần mô tả để SEO tốt hơn">{{ $data->product_desc }}</textarea>
                                        <p class="col-12" style="padding-left:0;padding-top:10px;font-weight:bold">(Tốt
                                            nhất là 250 - 300 ký tự) <strong style="color:red;">- Chú ý: Bạn phải nhập phần
                                                mô tả để có kết quả SEO tốt nhất trên Google</strong></p>
                                    </div>
                                    <div class="form-group pd-10 pd-row-2">
                                        <label>Nội dung</label>
                                        <textarea class="col-10 form-control" name="product_content" id="pro_content" rows="3">{{ $data->product_content }}</textarea>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card" style="border-top:1px solid rgba(0,0,0,.125);">
                        <ul class="nav nav-pills">
                            <li class="nav-content pd-row" style="border-right:1px solid rgba(0,0,0,.125);"><i
                                    class="fa fa-certificate" aria-hidden="true"></i></li>
                            <li class="nav-content pd-row">Dữ liệu sản phẩm ---</li>
                            <li class="nav-content">
                                <select class="form-control is_variation" name="is_variation" id="is_variation"
                                    onchange="chooseProduct();" style="width:100%;">
                                    @if ($data->is_variation == '0')
                                        <option value="0"><a class="nav-link active" href="#infomation"
                                                data-toggle="tab" selected="selected">Sản phẩm đơn giản</a></option>
                                        <option value="1"><a class="nav-link" href="#content" data-toggle="tab">Sản
                                                phẩm biến thể</a></option>
                                    @else
                                        <option value="1"><a class="nav-link" href="#content" data-toggle="tab"
                                                selected="selected">Sản phẩm biến thể</a></option>
                                        <option value="0"><a class="nav-link active" href="#infomation"
                                                data-toggle="tab">Sản phẩm đơn giản</a></option>
                                    @endif
                                </select>
                            </li>
                        </ul>
                        <div style="border-top:1px solid rgba(0,0,0,.125)">
                        </div>
                        <div class="card-body" style="padding:0;">
                            @if ($data->is_variation == '0')
                                <div class="type-nomarl">
                                    <input type="hidden" name="input_type" value="normal">
                                    <div class="row normalPro">
                                        <div class="col-5 col-sm-3">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <a class="nav-link active" id="vert-tabs-general-tab" data-toggle="pill"
                                                    href="#vert-tabs-general" role="tab"
                                                    aria-controls="vert-tabs-home" aria-selected="false"><i
                                                        class="fa fa-wrench icon-pd" aria-hidden="true"></i> Chung</a>
                                            </div>
                                        </div>
                                        <div class="col-7 col-sm-9" style="padding:0.75rem;">
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                <div class="tab-pane text-left fade show active" id="vert-tabs-general"
                                                    role="tabpanel" aria-labelledby="vert-tabs-general-tab">
                                                    <div class="row pd-10">
                                                        <label class="col-3">Giá sản phẩm (₫)</label>
                                                        <input type="number" hidden class="tientehidden"
                                                            id="product_price" name="product_price"
                                                            value="{{ $data->product_price }}">
                                                        <input type="text" class="col-7 tiente mucgiam form-control"
                                                            placeholder="VND" value="{{ $data->product_price }}">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row variantPro" style="display:none">
                                        <div class="col-5 col-sm-3">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                                    href="#vert-tabs-properties" role="tab"
                                                    aria-controls="vert-tabs-properties" aria-selected="true"><i
                                                        class="fa fa-list-alt icon-pd" aria-hidden="true"></i> Thuộc
                                                    tính</a>
                                                <a class="nav-link" id="vert-tabs-variant-tab" data-toggle="pill"
                                                    href="#vert-tabs-variant" role="tab"
                                                    aria-controls="vert-tabs-home" aria-selected="false"><i
                                                        class="fa fa-random icon-pd" aria-hidden="true"></i> Biến thể</a>
                                            </div>
                                        </div>
                                        <div class="col-7 col-sm-9" style="padding:0.75rem;">
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                <div class="tab-pane text-left fade show active" id="vert-tabs-properties"
                                                    role="tabpanel" aria-labelledby="vert-tabs-properties-tab">
                                                    <div style="padding-bottom:10px;"><a class="btn btn-primary"
                                                            style="color:#2271b1;border-color: #2271b1;background: #f6f7f7;"
                                                            onclick="typeProperties()">Thêm thuộc tính cho sản phẩm </a>
                                                    </div>

                                                    <div id="vert-tabs-content-properties-type">

                                                    </div>
                                                </div>
                                                <div class="tab-pane text-left fade" id="vert-tabs-variant"
                                                    role="tabpanel" aria-labelledby="vert-tabs-variant-tab">
                                                    Hãy cập nhật ở danh sách sản phẩm..
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="type-variant">
                                    <input type="hidden" name="input_type" value="variant">
                                    <div class="row variantPro">
                                        <div class="col-5 col-sm-3">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                                    href="#vert-tabs-properties" role="tab"
                                                    aria-controls="vert-tabs-properties" aria-selected="true"><i
                                                        class="fa fa-list-alt icon-pd" aria-hidden="true"></i> Thuộc
                                                    tính</a>
                                                <a class="nav-link" id="vert-tabs-variant-tab" data-toggle="pill"
                                                    href="#vert-tabs-variant" role="tab"
                                                    aria-controls="vert-tabs-home" aria-selected="false"><i
                                                        class="fa fa-random icon-pd" aria-hidden="true"></i> Biến thể</a>
                                            </div>
                                        </div>
                                        <div class="col-7 col-sm-9" style="padding:0.75rem;">
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                <div class="tab-pane text-left fade show active" id="vert-tabs-properties"
                                                    role="tabpanel" aria-labelledby="vert-tabs-properties-tab">
                                                    <div style="padding-bottom:10px;"><a class="btn btn-primary"
                                                            style="color:#2271b1;border-color: #2271b1;background: #f6f7f7;"
                                                            onclick="addProperties()">Thêm thuộc tính cho sản phẩm </a>
                                                    </div>
                                                    <!-- /thuộc tính cũ -->
                                                    <div id="last-properties">
                                                        @foreach ($properties as $propertie)
                                                            <div class="card bg-gradient-last collapsed-card"
                                                                style="color:#555;border-left-color: #6BB5D8;border-left-width: 4px;background-color:#f6f7f7;">
                                                                <div class="card-header border-0 ui-sortable-handle"
                                                                    style="cursor: move;">
                                                                    <h3 class="card-title">
                                                                        {{ $propertie->propertie_name }}</h3>
                                                                    <div class="card-tools">
                                                                        <button type="button" class="btn bg-dark btn-sm"
                                                                            data-card-widget="collapse"><i
                                                                                class="fas fa-plus"></i></button>
                                                                        <button type="button" id=""
                                                                            class="btn bg-dark btn-sm removePropertie"
                                                                            data-url="/product/deletePropertie/{{ $propertie->id }}/{{ $data->id }}"><i
                                                                                class="fas fa-times"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body"
                                                                    style="display:none;border-top-width:3px;border-top-style:solid;border-top-color:#EAECF0;">
                                                                    <input type="hidden" name="propertie_id[]"
                                                                        value="{{ $propertie->id }}">
                                                                    <div class="row pd-10">
                                                                        <label class="col-3">Tên:</label>
                                                                        <input type="text" name="propertie_name[]"
                                                                            value="{{ $propertie->propertie_name }}"
                                                                            class="col-7 form-control" id=""
                                                                            placeholder="Tên thuộc tính">
                                                                    </div>
                                                                    <div class="row pd-10"><label class="col-3">Giá
                                                                            trị(s):</label>
                                                                        <textarea class="col-7 form-control" name="propertie_value[]" rows="3"
                                                                            placeholder="Nhập nội dung hoặc một số thuộc tính bằng '|' các giá trị riêng.">{{ $propertie->propertie_value }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- /thuộc tính mới -->
                                                    <div id="new-properties">
                                                        <input type="hidden" id="input-propertie"
                                                            name="input_propertie">
                                                        <div id="vert-tabs-content-properties">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane text-left fade" id="vert-tabs-variant"
                                                    role="tabpanel" aria-labelledby="vert-tabs-variant-tab">
                                                    Hãy cập nhật ở danh sách sản phẩm..
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row normalPro" style="display:none;">
                                        <div class="col-5 col-sm-3">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <a class="nav-link active" id="vert-tabs-general-tab" data-toggle="pill"
                                                    href="#vert-tabs-general" role="tab"
                                                    aria-controls="vert-tabs-home" aria-selected="false"><i
                                                        class="fa fa-wrench icon-pd" aria-hidden="true"></i> Chung</a>
                                            </div>
                                        </div>
                                        <div class="col-7 col-sm-9" style="padding:0.75rem;">
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                <div class="tab-pane text-left fade show active" id="vert-tabs-general"
                                                    role="tabpanel" aria-labelledby="vert-tabs-general-tab">
                                                    <div class="row pd-10">
                                                        <label class="col-3">Giá sản phẩm (₫)</label>
                                                        <input type="number" name="product_price"
                                                            class="col-7 form-control" id=""
                                                            value="{{ old('product_price') }}" placeholder="Giá">
                                                        @error('product_price')
                                                            <span class="col-4"></span>
                                                            <span class="col-8 help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card" id="div_configuration"
                        style="border-top:1px solid rgba(0,0,0,.125);display:none;">
                        <ul class="nav nav-pills">
                            <li class="nav-content" style="border-right:1px solid rgba(0,0,0,.125);"><i
                                    class="fa fa-barcode" aria-hidden="true"></i></li>
                            <li class="nav-content">Thông số kỹ thuật</li>
                        </ul>
                        <div style="border-top:1px solid rgba(0,0,0,.125)">
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="infomation">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row pd-10">
                                                <label class="col-4">Màn hình</label>
                                                <input type="text" name="config_screen" value="<?php if ($configuration != null) {
                                                    echo $configuration->config_screen;
                                                } ?>"
                                                    class="col-8 form-control" id="" placeholder="Vd:6.7">
                                                @error('config_screen')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">CPU</label>
                                                <input type="text" name="config_cpu" value="<?php if ($configuration != null) {
                                                    echo $configuration->config_cpu;
                                                } ?>"
                                                    class="col-8 form-control" id=""
                                                    placeholder="Vd:Apple A15 Bionic">
                                                @error('config_cpu')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Ram</label>
                                                <input type="text" name="config_ram" value="<?php if ($configuration != null) {
                                                    echo $configuration->config_ram;
                                                } ?>"
                                                    class="col-8 form-control" id="" placeholder="Vd:6G">
                                                @error('config_ram')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Camera sau</label>
                                                <input type="text" name="config_camera" value="<?php if ($configuration != null) {
                                                    echo $configuration->config_camera;
                                                } ?>"
                                                    class="col-8 form-control" id="" placeholder="Vd:12.0">
                                                @error('config_camera')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6" style="padding:0 50px;">
                                            <div class="row pd-10">
                                                <label class="col-4">Camera trước</label>
                                                <input type="text" name="config_selfie" value="<?php if ($configuration != null) {
                                                    echo $configuration->config_selfie;
                                                } ?>"
                                                    class="col-8 form-control" id="" placeholder="Vd:12.0">
                                                @error('config_selfie')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Pin</label>
                                                <input type="text" name="config_battery" value="<?php if ($configuration != null) {
                                                    echo $configuration->config_battery;
                                                } ?>"
                                                    class="col-8 form-control" id="" placeholder="Vd:4352 mAh">
                                                @error('config_battery')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row pd-10">
                                                <label class="col-4">Hệ điều hành</label>
                                                <input type="text" name="config_system" value="<?php if ($configuration != null) {
                                                    echo $configuration->config_system;
                                                } ?>"
                                                    class="col-8 form-control" id="" placeholder="Vd:iOS">
                                                @error('config_system')
                                                    <span class="col-4"></span>
                                                    <span class="col-8 help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="card" style="border-top:1px solid rgba(0,0,0,.125)">
                        <div class="row" style="margin-left:3px;">
                            <ul class="nav nav-pills col-4">
                                <li class="nav-content pd-row" style="border-right:1px solid rgba(0,0,0,.125);"><i
                                        class="fa fa-certificate" aria-hidden="true"></i></li>
                                <li class="nav-content pd-row">Nội dung SEO</li>
                            </ul>
                            <ul class="nav nav-pills col-8">
                                <li class="nav-content pd-row">SEO Google được chuyên gia Đà Nẵng update vào ngày:
                                    02/07/2022</i></li>
                                <li class="nav-content"><button type="button" class="btn btn-success">Xem hướng
                                        dẫn</button></li>
                            </ul>
                        </div>
                        <div style="border-top:1px solid rgba(0,0,0,.125)"></div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="row pd-10">
                                    <label class="col-2">Title</label>
                                    <div class="input-group mb-3 col-10">
                                        <input type="text" class="form-control" value="{{ $data->seo_title }}"
                                            name="seo_title" placeholder="Nội dung thẻ meta Title dùng để SEO"
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1">70</span>
                                    </div>
                                </div>
                                <div class="row pd-10">
                                    <label class="col-2">Description</label>
                                    <div class="input-group mb-3 col-10">
                                        <input type="text" class="form-control" value="{{ $data->seo_description }}"
                                            name="seo_description" placeholder="Từ khóa chính cho bài viết"
                                            aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row pd-10">
                                    <label class="col-2">Từ khóa</label>
                                    <div class="input-group mb-3 col-10">
                                        <input type="text" class="form-control" value="{{ $data->seo_keywords }}"
                                            name="seo_keywords" placeholder="Nội dung thẻ meta Description dùng để SEO"
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1">156</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    @csrf
                </form>
                <!-- /form propertie -->
                <div class="card bg-gradient-new" id="add-properties"
                    style="display:none;color:#555;border-left-color: #28a745;border-left-width: 4px;background-color:#f6f7f7">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">thuộc tính mới</h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" id="remove" class="btn bg-success btn-sm" onclick="remove()"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="border-top-width:3px;border-top-style:solid;border-top-color:#EAECF0;">
                        <div class="row pd-10">
                            <label class="col-3">Tên:</label>
                            <input type="text" name="propertie_name_n[]" class="col-7 form-control" id=""
                                placeholder="Tên thuộc tính">
                        </div>
                        <div class="row pd-10"><label class="col-3">Giá trị(s):</label>
                            <textarea class="col-7 form-control" name="propertie_value_n[]" rows="3"
                                placeholder="Nhập nội dung hoặc một số thuộc tính bằng '|' các giá trị riêng."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./col -->

    </div><!-- /.container-fluid -->

    <!-- /.content -->
    </div>
@endsection
@push('scripts')
    <script>
        function check() {
            if ($('#is_configuration_product').is(':checked')) {
                $('#div_configuration').show();
            }
        }
        $(function() {
            check();
        })
    </script>
    <script>
        // chọn thông số kỹ thuật
        function chooseConfiguration() {
            if ($('#is_configuration_product').is(':checked')) {
                $('#div_configuration').show();
            } else {
                $('#div_configuration').hide();
            }
        }
        // chọn loại sp
        function chooseProduct() {
            var valueIp = $('#is_variation').val();
            if (valueIp === '1') {
                $('.variantPro').show();
                $('.normalPro').hide();
            } else {
                $('.variantPro').hide();
                $('.normalPro').show();
            }
        }

        function typeProperties() {
            $("#add-properties").clone().appendTo("#vert-tabs-content-properties-type");
            $("#add-properties").show();
        }
        // thêm thuộc tính
        function addProperties() {
            if (confirm('Bạn có chắc muốn thêm thuộc tính mới không ?')) {
                $("#add-properties").clone().appendTo("#vert-tabs-content-properties");
                $("#add-properties").show();
                $('#input-propertie').val('check');
            }
        }
        // tắt thêm thuộc tính
        function remove() {
            $('#add-properties').remove();
        }
        // ảnh sản phẩm
        function ImagesFileAsURL() {
            var fileSelected = document.getElementById('img_product').files;
            var imgNow = document.getElementById('imgNow');
            if (fileSelected.length > 0) {
                imgNow.classList.add("hide");
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
        // list hình ảnh
        function ImagesListFileAsURL() {
            var fileSelected = document.getElementById('img_list').files;
            var imgListNow = document.getElementById('imgListNow');
            if (fileSelected.length > 0) {
                imgListNow.classList.add("hide");
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
    <script>
        // Xóa thuộc tính đã có
        $(".removePropertie").click(function() {
            let urlRequest = $(this).data('url');
            let that = $(this);
            if (confirm('Bạn có chắc muốn xóa mục này không ?')) {
                $.ajax({
                    type: 'GET',
                    datatype: 'JSON',
                    url: urlRequest,
                    success: function() {
                        that.parent().parent().parent().remove();
                    }
                })
            }
        });
    </script>
@endpush
