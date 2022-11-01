
<div class="render-product">

@foreach ($all_product as $key => $all)
            
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
                                    {{-- <form action="{{URL::to('/save-cart')}}" method="post">
                                        {{ csrf_field() }} --}}
                                        {{-- <input type="hidden" name="qty" value="1">
                                        <input type="hidden" name="productid_hidden" value="{{$all->product_id}}"/> --}}
                                        {{-- <button data-product_id="{{$all->product_id}}" type="button" class="btn btn-default add-to-cart" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button> --}}
                                    {{-- </form> --}}
                                </form>                 
                            </div>
                    </div>
                    
                </div>
            </div>
      
    @endforeach
  
    <div class="box-footer clearfix">
        @if(Request::route()->getName() == 'pages.product')
                
            <ul class="pagination pagination-sm no-margin pull-right">
                {!!$all_product->appends($query ?? [])->links()!!}
            </ul>
        @endif
    </div>
</div> 
