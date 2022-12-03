@extends('layout/masterLayout')
@section('title')
Cập nhật thông tin cửa hàng
@endsection
@push('style')
<style>
    #img_priv img {
        height: 80px;
        width: 80px;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <x-alert errorText="{{ trans('alert.update.error') }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Thông tin </h3>
                </div>
                <form method="POST" action="{{route('info.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_name">Tên </label>
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" placeholder="Nhập tên cửa hàng" value="{{ $company->company_name}}">
                                    @error('company_name')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_favicon">Favicon </label>
                                    <input type="file" onchange="img_priv()" class="form-control @error('company_favicon') is-invalid @enderror" id="company_favicon" name="company_favicon">
                                    @error('company_favicon')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                    <div class="preview-upload my-2" id="img_priv">
                                        <div id="img_last">
                                            @if($company->company_favicon)
                                            <img src="{{$company->company_favicon}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_address">Địa chỉ </label>
                                    <input type="text" class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" placeholder="Nhập địa chỉ" value="{{ $company->company_address}}">
                                    @error('company_address')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_hotline">Hotline </label>
                                    <input type="text" class="form-control @error('company_hotline') is-invalid @enderror" id="company_hotline" name="company_hotline" placeholder="Nhập hotline" value="{{ $company->company_hotline}}">
                                    @error('company_hotline')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_phone">Điện thoại </label>
                                    <input type="text" class="form-control @error('company_phone') is-invalid @enderror" id="company_phone" name="company_phone" placeholder="Nhập số điện thoại" value="{{ $company->company_phone}}">
                                    @error('company_phone')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_email">Email </label>
                                    <input type="text" class="form-control @error('company_email') is-invalid @enderror" id="company_email" name="company_email" placeholder="Nhập địa chỉ email" value="{{ $company->company_email}}">
                                    @error('company_email')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_fanpage">Fanpage </label>
                                    <input type="text" class="form-control @error('company_fanpage') is-invalid @enderror" id="company_fanpage" name="company_fanpage" placeholder="Nhập địa chỉ Fanpge" value="{{ $company->company_fanpage}}">
                                    @error('company_fanpage')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_copyright">Copyright </label>
                                    <input type="text" class="form-control @error('company_copyright') is-invalid @enderror" id="company_copyright" name="company_copyright" placeholder="Copyright" value="{{ $company->company_copyright}}">
                                    @error('company_copyright')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_work_day">Ngày làm việc </label>
                                    <input type="text" class="form-control @error('company_work_day') is-invalid @enderror" id="company_work_day" name="company_work_day" placeholder="Nhập ngày làm việc" value="{{ $company->company_work_day}}">
                                    @error('company_work_day')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_work_time">Giờ làm việc </label>
                                    <input type="text" class="form-control @error('company_work_time') is-invalid @enderror" id="company_work_time" name="company_work_time" placeholder="Nhập giờ làm việc" value="{{ $company->company_work_time}}">
                                    @error('company_work_time')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_ggmap">Google map </label>
                                    <textarea id="company_ggmap" name="company_ggmap" class="form-control @error('company_ggmap') is-invalid @enderror" cols="30" rows="4"> {{ $company->company_ggmap}} </textarea>
                                    @error('company_ggmap')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_gg_analytic">Google Analytic </label>
                                    <textarea id="company_gg_analytic" name="company_gg_analytic" class="form-control @error('company_gg_analytic') is-invalid @enderror" cols="30" rows="4"> {{ $company->company_gg_analytic}} </textarea>
                                    @error('company_gg_analytic')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_title">SEO Title </label>
                                    <input type="text" class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" name="seo_title" placeholder="Nhập tiêu đề SEO" value="{{ $company->seo_title}}">
                                    @error('seo_title')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_keyword">SEO Keyword </label>
                                    <textarea id="seo_keyword" name="seo_keyword" class="form-control @error('seo_keyword') is-invalid @enderror" cols="30" rows="4"> {{ $company->seo_keyword}} </textarea>
                                    @error('seo_keyword')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_description">SEO Description </label>
                                    <textarea id="seo_description" name="seo_description" class="form-control @error('seo_description') is-invalid @enderror" cols="30" rows="4"> {{ $company->seo_description}} </textarea>
                                    @error('seo_description')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@prepend('scripts')
<script>
    function img_priv() {
        var fileSelected = document.getElementById('company_favicon').files;
        var imgLast = document.getElementById('img_last');
        if (fileSelected.length > 0) {
            imgLast.classList.add("d-none");
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
@endprepend
