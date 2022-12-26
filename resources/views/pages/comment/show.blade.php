@extends('layout/masterLayout')
@section('title')
Thông tin đánh giá
@endsection
@push('style')
<style>
    .cursor-help {
        cursor: help;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin đánh giá </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-widget">
                                <div class="card-header">
                                    <div class="user-block">
                                        <img class="img-circle" src="{{$comment->product->product_image}}" alt="User Image">
                                        <span class="username"><a href="{{ env('FRONTEND_URL') }}/{{$comment->product->id}}">{{$comment->product->product_name}}</a></span>
                                        <span class="description"> {{$comment->product->created_at}}</span>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <img class="img-fluid pad" width="200" height="200" src="{{$comment->product->product_image}}" alt="Photo">
                                        <div class="ml-3">
                                            <a href="{{ env('FRONTEND_URL') }}/{{$comment->product->id}}">{{$comment->product->product_name}}</a>
                                            <p>{{$comment->product->product_promotion_desc}}</p>
                                            <a target="_blank" href="{{ env('FRONTEND_URL') }}/{{$comment->product->id}}" class="btn btn-sm btn-info">Xem chi tiết</a>
                                            <span class="btn btn-success btn-sm {{$comment->comment_display==0?'accept':''}} " data-id="{{$comment->id}}">Duyệt</span>
                                        </div>
                                    </div>
                                    <span class="float-right text-muted"> {{$countAll}} đánh giá</span>
                                </div>
                                <div class="card-footer card-comments">
                                    <div class="card-comment hiddenClassCursor {{$comment->comment_display==0?'cursor-help':''}}" title="{{$comment->comment_display==0?'Đánh giá chưa được duyệt':''}}">
                                        <img class="img-circle img-sm" src="{{asset('default-avatar.png')}}" alt="">
                                        <div class="comment-text">
                                            <span class="d-block hiddenClassUsername {{$comment->comment_display==1?'username':''}}">
                                                {{$comment->comment_name}}
                                                <span class="text-muted float-right"> {{$comment->created_at}}</span>
                                            </span>
                                            {{$comment->comment_content}}
                                        </div>
                                    </div>
                                    @foreach($comment->childrenComment as $child)
                                    <div class="card-footer card-comments">
                                        <div class="card-comment hiddenClassCursor {{$child->comment_display==0?'cursor-help':''}}" title="{{$comment->comment_display==0?'Đánh giá chưa được duyệt':''}}">
                                            <img class="img-circle img-sm" src="{{asset('default-avatar.png')}}" alt="">
                                            <div class="comment-text">
                                                <span class="d-block hiddenClassUsername {{$child->comment_display==1?'username':''}}">
                                                    {{$child->comment_name}} <small style="font-size:10px" class="badge badge-danger"><i>( Quản trị viên )</i>    </small>
                                                    <span class="text-muted float-right"> {{$child->created_at}}</span>
                                                </span>
                                                {{$child->comment_content}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <form action="{{route('comment.reply')}}" method="post">
                                        @csrf
                                        <img class="img-fluid img-circle img-sm" src="{{asset('default-avatar.png')}}" alt="Alt Text">
                                        <div class="img-push">
                                            <input type="hidden" name="product_id" value="{{$comment->product_id}}">
                                            <input type="hidden" name="id" value="{{$comment->id}}">
                                            <input type="text" required class="form-control form-control-sm" value="{{old('reply_content')}}" name="reply_content" placeholder="Phản hồi đánh giá">
                                            <button {{$comment->comment_display==0?'disabled':''}} type="submit" class="my-2 btn btn-sm btn-primary btnReply">Phản hồi</button>
                                        </div>
                                    </form>
                                </div>
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
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/comment/show.js')}}"></script>
@endprepend
