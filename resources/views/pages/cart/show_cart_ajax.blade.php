@extends('404')
<title>
    Giỏ hàng của bạn
</title>
@section('content')
<section id="cart_items">
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Trang chủ</a></li>
        <li style="color: red">Giỏ hàng của bạn</li>
      </ul>
    {{-- @php
    print_r(Session::get('cart'));
    @endphp --}}
    @if (Session::get('cart')==true)
    <div class="table-responsive cart_info box-body no-padding">
        <form action="{{url('/update-cart')}}" method="POST">
            @csrf
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Hình ảnh</td>
                    <td class="description">Tên sản phẩm</td>
                    <td class="color">Màu sắc</td>
                    <td class="memory">Bộ nhớ</td>
                    <td class="price" style="width: 146px">Giá sản phẩm</td>
                    <td class="quantity" style="width: 135px">Số lượng</td>
                    <td class="total" style="width: 182px">Thành tiền</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach (Session::get('cart') as $cart)   
                    @php
                        $subtotal = $cart['product_qty']*$cart['product_price'];
                        $total += $subtotal;
                    @endphp
                    <tr class="cartpage">
                        <input type="hidden" class="session-id" value="{{$cart['session_id']}}">
                        <input type="hidden" class="pprice" value="{{$cart['product_price']}}">
                        <td class="cart_product">
                            <a href="{{URL::to('product/'.$cart['product_slug'])}}"><img src="{{URL::to('/public/uploads/product/'.$cart['product_image'])}}" alt="" width="75px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart['product_name']}}</a></h4>
                            <p></p>
                        </td>
                        <td class="cart_color">
                            <p>{{$cart['product_color']}}</p>
                        </td>
                        <td class="cart_memory">
                            <p>{{$cart['product_memory']}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cart['product_price'], 0, '.','.') }} Đ</p>
                        </td>
                        <td class="cart_quantity">
                                <span class="new-cart-quantity quantity">
                                    <input value="-" class="decrement-btn changeQuantity">
                                    <input class="qty-input"   value="{{$cart['product_qty']}}"   name="cart_qty[{{$cart['session_id']}}]" size="3">
                                    <input value="+" class="increment-btn changeQuantity">
                                </span>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_sub">{{number_format($subtotal, 0, '.','.') }} Đ</p>
                        </td>
                        <td class="cart_delete">
                            {{-- <a class="cart_quantity_delete" href="{{url('/delete-cart/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a> --}}
                            <a class="cart_quantity_delete" data-url="{{url('/delete-cart-ajax/'.$cart['session_id'])}}" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                   
                @endforeach
                <tr class="cart-total">
                    <td colspan="6" align="right" style="font-weight: bold;">Tổng cộng: </td>
                    <th class="cart_total_price"><?php echo number_format($total, 0, '.','.') .' Đ'?></th>
                </tr>
               <tr>
                   {{-- <td><input type="submit" class="check_out" value="Cập nhật"></td> --}}
                   {{-- <td><a href="{{url('/delete-all-cart')}}" class="btn btn-sm check_out">Xóa giỏ hàng </a>  </td> --}}
                   <td><a href="" class="btn btn-sm check_out delete-all-cart">Xóa giỏ hàng </a>  </td>
               </tr>    
            </tbody>
            
        </table>
        <div class="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="total_area pull-right">           
                        <?php 
                            $customer_id = Session::get('customer_id');
                            $shipping_id = Session::get('shipping_id');
                            if($customer_id != null && $shipping_id == null){
                            ?>
                                <a href="{{URL::to('/checkout')}}" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                            <?php
                            }elseif($customer_id != null && $shipping_id != null){
                            ?>
                                <a href="{{URL::to('/checkout')}}" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                            <?php
                            }else{
                            ?>
                                <a href="{{URL::to('/login')}}" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                            <?php
                            }					
                        ?>
                    </div>
                </div>
            </div>
        </div>    
        </form>
        
    </div>
    
    @else
    <div class="alert alert-success">Giỏ hàng đang trống!
        
    </div>
    <div class="cart-empty"><img src="{{asset('/public/frontend/images/empty-cart.png')}}" alt=""></div>
    @endif     
    
</section> <!--/#cart_items-->

@endsection