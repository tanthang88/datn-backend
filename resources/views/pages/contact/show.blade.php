@extends('layout/masterLayout')
@section('title')
Thông tin liên hệ
@endsection
@push('style')
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin liên hệ </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="about_name">Tiêu đề: </label>
                                <span>{{$contact->subject}}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="about_name">Tên khách hàng: </label>
                                <span>{{$contact->customer_name}}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="about_name">Nội dung: </label>
                                <span>{{$contact->content}}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="about_name">Số điện thoại: </label>
                                <span><a href="tel:{{$contact->phone}}">{{$contact->phone}}</a></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="about_name">Email: </label>
                                <span>{{$contact->email}}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="about_name">Ngày gửi: </label>
                                <span>{{$contact->sent_date}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
