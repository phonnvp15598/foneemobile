@extends('blog')
<title>
   {{$blog_detail->blog_title}}
</title>
@section('content')
<div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
    <div class="blog--list-view">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Trang chủ</a></li>
            <li><a href="{{url('/blog')}}">Bài viết</a></li>
            <li style="color: red">{{$blog_detail->blog_title}}</li>
          </ul>
        <div class="article"> 
            <!-- Article Image --> 
             <a class="article_img" href="#"><img class="blur-up ls-is-cached lazyloaded" src="{{asset('/public/uploads/product/'.$blog_detail->blog_thumb)}}"></a> 
            <h1><a href="blog-left-sidebar.html">{{$blog_detail->blog_title}}</a></h1>
            <ul class="publish-detail">                      
                <li><i class="fa fa-user" aria-hidden="true"></i>  {{$blog_detail->users->name}}</li>
                <li><i class="fa fa-clock-o"></i> <time>{{date_format($blog_detail->created_at,'d/m/y/ H:i')}}</time></li>
            </ul>
            <div class="rte"> 
                {!!$blog_detail->blog_content !!}
            </div>
            <hr>
            <div class="social-sharing">
                <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-facebook" title="Share on Facebook">
                    <i class="fa fa-facebook-square" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Share</span>
                </a>
                <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-twitter" title="Tweet on Twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Tweet</span>
                </a>
                <a href="#" title="Share on google+" class="btn btn--small btn--secondary btn--share">
                    <i class="fa fa-google-plus" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Google+</span>
                </a>
                <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-pinterest" title="Pin on Pinterest">
                    <i class="fa fa-pinterest" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Pin it</span>
                </a>
                <a href="#" class="btn btn--small btn--secondary btn--share share-pinterest" title="Share by Email" target="_blank">
                    <i class="fa fa-envelope" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Email</span>
                </a>
            </div>
        </div>
        
    </div>
</div>
@endsection