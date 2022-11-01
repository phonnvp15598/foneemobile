@extends('blog')
<title>
   Tin tức về công nghệ
</title>
@section('content')
<div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
    <div class="blog--list-view">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Trang chủ</a></li>
            <li style="color: red">Bài viết</li>
          </ul>
        <div class="row">
            @foreach ($all_blog as $blog)
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                <!-- Article Image --> 
                 <a class="article_featured-image" href="{{url('/blog/'.$blog->blog_slug)}}"><img class="blur-up ls-is-cached lazyloaded"  src="{{asset('/public/uploads/product/'.$blog->blog_thumb)}}"></a> 
                <h3 class="h3"><a href="{{url('/blog/'.$blog->blog_slug)}}">{{$blog->blog_title}}</a></h3>
                <ul class="publish-detail">                      
                    <li><i class="fa fa-user" aria-hidden="true"></i>  {{$blog->users->name}}</li>
                    <li><i class="fa fa-clock-o"></i> {{date_format($blog->created_at,'d/m/y/ H:i')}}</li>
                </ul>
                {{-- <div class="rte"> 
                    <p>{!!substr($blog->blog_content,0,100)!!}...</p>
                </div> --}}
                
            </div>
            @endforeach
        </div>
        
    </div>
</div>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
      {{$all_blog->appends(Request::all())->links()}}
    </ul>
  </div>
@endsection