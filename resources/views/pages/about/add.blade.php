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
                    <form action="" method="post" class="col-12" enctype="multipart/form-data">
                            <div class="row" style="padding-bottom:20px;">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check" aria-hidden="true" style="padding-right:3px;"></i>Hoàn tất</button>
                                    <button type="button" class="btn btn-warning"><a href="{{route('about.list')}}" style="color:black"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a></button>
                                </div>
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
                                                <div class="col-12">
                                                    <div class="row pd-10">
                                                        <label class="col-2">Tên thông tin</label>
                                                        <input type="text" name="about_name" id="about_name" class="col-10 form-control @error('about_name') is-invalid @enderror" value="{{ old('about_name')}}" placeholder="Tên thông tin">
                                                        @error('about_name')
                                                            <span class="col-2"></span>
                                                            <small class="error-form col-10" style="color: red;font-style: italic"> {{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="row pd-10">
                                                        <label class="col-2">Loại</label>
                                                        <input type="text" name="type" id="type" class="col-10 form-control @error('type') is-invalid @enderror" value="{{ old('type')}}" placeholder="loại">
                                                        @error('type')
                                                            <span class="col-2"></span>
                                                            <small class="error-form col-10" style="color: red;font-style: italic"> {{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="row pd-10">
                                                        <label class="col-2">Hiển thị</label>
                                                        <input type="checkbox" checked name="about_display">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="content">
                                            <div class="row pd-10">
                                                <label class="col-2">Mô tả</label>
                                                <textarea class="col-12 form-control" name="about_desc" rows="3" placeholder="Bạn bắt buộc phải nhập phần mô tả để SEO tốt hơn"></textarea>
                                                <p class="col-10" style="padding-left:0;padding-top:10px;font-weight:bold">(Tốt nhất là 250 - 300 ký tự) <strong style="color:red;">- Chú ý: Bạn phải nhập phần mô tả để có kết quả SEO tốt nhất trên Google</strong></p>
                                                </select>
                                            </div>
                                            <div class="form-group pd-10" style="margin-left:-7.5px; margin-right:-7.5px;">
                                                <label>Nội dung</label>
                                                <textarea class="col-10 form-control" name="about_content" id="pro_content" rows="3"></textarea>
                                                </select>
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
                                                <input type="text" class="form-control" value="{{ old('seo_title')}}" id="seo_title"  name="seo_title" placeholder="Nội dung thẻ meta Title dùng để SEO" aria-describedby="basic-addon1">
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
            </div>
        </div><!-- /.container-fluid -->

    <!-- /.content -->
</div>
@endsection
