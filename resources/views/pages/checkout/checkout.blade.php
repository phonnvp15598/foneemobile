@extends('404')
<title>
    Thanh toán
</title>
@section('content')
<section id="cart_items">
    <div class="">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Trang chủ</a></li>
            <li style="color: red">Thanh toán</li>
          </ul>
        <div class="review-payment">
            <h2>Xem chi tiết đơn hàng & thanh toán</h2>
        </div>
        <?php
            if(Session::get('cart')){ ?>
                <div class="table-responsive cart_info">
            
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
                                    <input type="hidden" class="pid" value="{{$cart['product_id']}}">
                                    <input type="hidden" class="session-id" value="{{$cart['session_id']}}">
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
                                        <p>{{$cart['product_qty'] }} </p>
                                    </td>
                                    
                                    <td class="cart_total">
                                        <p class="cart_total_sub">{{number_format($subtotal, 0, '.','.') }} Đ</p>
                                    </td>
                                    <td class="cart_delete">
                                        {{-- <a class="cart_quantity_delete" data-url="{{url('/delete-cart-ajax/'.$cart['session_id'])}}" href=""><i class="fa fa-times"></i></a> --}}
                                        {{-- <a class="cart_quantity_delete" href="{{url('/delete-cart/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a> --}}
                                    </td>
                                </tr>
                               
                            @endforeach
                            <tr class="cart-total">
                                <td colspan="6" align="right" style="font-weight: bold;">Tổng cộng: </td>
                                <th class="cart_total_price"><?php echo number_format($total, 0, '.','.') .' Đ'?></th>
                            </tr>
                           
                           
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-9 clearfix">
                            <div class="bill-to">
                                <p>Điền thông tin gửi hàng</p>
                                <div class="form-one">
                                    <form action="{{URL::to('order')}}" method="POST" class="form-group">
                                        {{ csrf_field() }}
                                        <input type="text" placeholder="Tên người nhận*" name="shipping_name" value="{{old('shipping_name')}}">
                                        @error('shipping_name')
                                            <span class="badge btn-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="text" placeholder="Email*" name="shipping_email" value="{{old('shipping_email')}}">
                                        @error('shipping_email')
                                            <span class="badge btn-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="text" placeholder="Số điện thoại*" name="shipping_phone" value="{{old('shipping_phone')}}">
                                        @error('shipping_phone')
                                            <span class="badge btn-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="text" placeholder="Địa chỉ giao hàng *" name="shipping_address" value="{{old('shipping_address')}}">
                                        @error('shipping_address')
                                            <span class="badge btn-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="">Chọn Tỉnh/Thành phố</label>
                                            
                                            <select name="city" id="city" class="form-control choose city">
                                                <option value="" >---Chọn Tỉnh/Thành phố---</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('city')
                                                <span class="badge btn-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="">Chọn Quận/Huyện</label>
                                            <select name="district" id="district" class="form-control choose district" >
                                                <option value="">---Chọn Quận/Huyện---</option>
                                            </select>
                                            @error('district')
                                                <span class="badge btn-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="">Chọn Phường/Xã</label>
                                            <select name="ward" id="ward" class="form-control ward" >
                                                <option value="">---Chọn Phường/Xã---</option>
                                            </select>
                                            @error('ward')
                                                <span class="badge btn-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                    <br>
                                            
                                                
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="order-message">
                                <p>Ghi chú</p>
                                <textarea  name="shipping_note" placeholder="Ghi chú đơn hàng" rows="5"></textarea>
                                
                            </div>	
                        </div>
                        <div class="col-sm-9">
                            <div class="payment-options">
                                <h2>Chọn hình thức thanh toán</h2>
                                <span>
                                    <label><input name="payment_method" value="1" type="radio" checked> Thanh toán bằng thẻ ATM</label>
                                </span>
                                <span>
                                    <label><input name="payment_method" value="2" type="radio" > Thanh toán khi nhận hàng</label>
                                </span> 
                                <div class="total_area">
                                    <p>Phí vận chuyển <span>Free</span></p>
                                    <p>Thành tiền <span style="color: red" class="total-checkout">{{number_format($total, 0, '.','.') }} Đ</span></p>
                                    <input type="hidden" name="total" value="{{$total}}" class="checkout-total">
                                    
                                    <button type="submit" class="btn btn-primary" name="send_order">Đặt hàng</button>
                                </div>                                               
                            </div>    
                        </div>
                    </form>   
                       
                       
                    </div>
                    
                </div>
            <?php
            }else { ?>
                 <div class="alert alert-success">Giỏ hàng đang trống!
            
                </div>
                <div><img src="{{asset('/public/uploads/product/emptycart.png')}}" alt=""></div>
            <?php
            } 
        ?>
    </div>    
    
</section> <!--/#cart_items-->

@endsection