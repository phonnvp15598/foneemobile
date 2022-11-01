@extends('product')
<title>
    @foreach ($brand_name as $key => $value)
                Thương hiệu {{$value->brand_name}}
            @endforeach
</title>
@section('content')
<div class="features_items"><!--features_items-->
    <div class="row">
        <div class="col-sm-8"> <h2 class="title text-center">
            @foreach ($brand_name as $key => $value)
                Thương hiệu {{$value->brand_name}}
            @endforeach
        </h2></div>
        <div class="col-sm-4">
            <div class="sort-by ">
                <form method="get" id="form_order">
                    <select name="orderby" class="orderby">
                        <option {{Request::get('orderby')== "md" ? "selected='selected'" : ""}} value="md" selected="selected">Mặc định</option>
                        <option {{Request::get('orderby')== "new" ? "selected='selected'" : ""}} value="new">Mới nhất</option>
                        <option {{Request::get('orderby')== "old" ? "selected='selected'" : ""}} value="old">Cũ nhất</option>
                        <option {{Request::get('orderby')== "price-asc" ? "selected='selected'" : ""}} value="price-asc">Giá: Tăng dần</option>
                        <option {{Request::get('orderby')== "price-desc" ? "selected='selected'" : ""}} value="price-desc">Giá: Giảm dần</option>
                        <option {{Request::get('orderby')== "name-asc" ? "selected='selected'" : ""}} value="name-asc">Tên: A-Z</option>
                        <option {{Request::get('orderby')== "name-desc" ? "selected='selected'" : ""}} value="name-desc">Tên: Z-A</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    
    @foreach ($brand_by_id as $key => $all)
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
                                    {{-- <button data-product_id="{{$all->product_id}}" type="button" class="btn btn-default add-to-cart" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button> --}}
                                   
                                </form>
                            </div>
                    </div>
                    
                </div>
            </div>
    @endforeach
    
    
    
</div>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
      {{$brand_by_id->appends(Request::all())->links()}}
    </ul>
  </div>
@endsection