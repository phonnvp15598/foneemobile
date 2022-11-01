@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
          <li class="active">Giỏ hàng của bạn</li>
        </ol>
    </div>
    @php
        $content= Cart::content();
        
    @endphp
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Hình ảnh</td>
                    <td class="description">Tên sản phẩm</td>
                    <td class="price" style="width: 146px">Giá sản phẩm</td>
                    <td class="quantity" style="width: 135px">Số lượng</td>
                    <td class="total" style="width: 182px">Tổng tiền</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($content as $value)
                <tr>
                    <td class="cart_product">
                        <a href="{{URL::to('chi-tiet-san-pham/'.$value->slug)}}"><img src="{{URL::to('/public/uploads/product/'.$value->options->image)}}" alt="" width="75px"></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{$value->name}}</a></h4>
                        <p>ID: {{$value->id}}</p>
                    </td>
                    <td class="cart_price">
                        <p>{{number_format($value->price)}} VND</p>
                    </td>
                    <td class="cart_quantity">
                       <form action="{{URL::to('/update-cart-quantity')}}" method="post">
                        {{ csrf_field() }}
                            <div class="cart_quantity_button">                           
                                <input style="width: 50px" class="cart_quantity_input" type="number" name="cart_quantity" value="{{$value->qty}}"  size="2"> 
                                <input type="hidden" name="rowId_cart" value="{{$value->rowId}}">  
                                <input type="submit" class="btn btn-success btn-sm" value="Cập nhật">                 
                            </div>
                        </form>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">{{number_format($value->qty*$value->price)}} VND</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$value->rowId)}}"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::subtotal()}}</span></li>
                    </ul>
                    
                    <?php 
						$customer_id = Session::get('customer_id');
						$shipping_id = Session::get('shipping_id');
						if($customer_id != null && $shipping_id == null){
						?>
							<a href="{{URL::to('/checkout')}}" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i> Thanh toán</a>
						<?php
						}elseif($customer_id != null && $shipping_id != null){
						?>
							<a href="{{URL::to('/payment')}}" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i>Thanh toán</a>
						<?php
						}else{
						?>
							<a href="{{URL::to('/login-checkout')}}" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i>Thanh toán</a>
						<?php
						}					
					?>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection