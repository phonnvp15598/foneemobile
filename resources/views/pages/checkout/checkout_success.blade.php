@extends('content')
<title>
    Đặt hàng thành công
</title>
@section('content')
<section id="cart_items">
    <div class="">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        
        <div class="review-payment">
            <h2>Cảm ơn bạn đã mua hàng của chúng tôi! Thường xuyên kiếm tra email đặt hàng của bạn để biết chi tiết thêm</h2>
        </div>
        
      
  
       
    </div>
</section> <!--/#cart_items-->

@endsection