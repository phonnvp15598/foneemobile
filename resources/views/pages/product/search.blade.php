@extends('content')
<title>
    Tìm kiếm {{$keyword}}
</title>
@section('content')
<div class="features_items"><!--features_items-->
<h2 class="title text-center">   Kết quả "{{$keyword}}" tìm thấy: {{count($search_product)}} sản phẩm
    </h2>
    @foreach ($search_product as $key => $all)
    <a href="{{URL::to('product/'.$all->product_slug)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <form>
                                @csrf
                                <input type="hidden" value="{{$all->product_id}}" class="cart_product_id_{{$all->product_id}}">
                                <input type="hidden" value="{{$all->product_name}}" class="cart_product_name_{{$all->product_id}}">
                                <input type="hidden" value="{{$all->product_image}}" class="cart_product_image_{{$all->product_id}}">
                                <input type="hidden" value="{{$all->product_price}}" class="cart_product_price_{{$all->product_id}}">
                                <input type="hidden" value="{{$all->product_slug}}" class="cart_product_slug_{{$all->product_id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$all->product_id}}">
                                <a href="{{URL::to('product/'.$all->product_slug)}}">
                                    <div class="fix-anh"><img src="{{URL::to('public/uploads/product/'.$all->product_image)}}" alt="" class="thumb"/></div>
                                </a>
                                <h2>{{number_format($all->product_price, 0, '.','.') }} Đ</h2>
                                <p style="text-transform: uppercase">{{$all->product_name}}</p>
                            </form>
                        </div>
                </div>
                
            </div>
        </div>
    </a>
    @endforeach 
</div>
<div style="text-center" class="pull-right">
    {{$search_product->appends(Request::all())->links()}}
</div>
@endsection