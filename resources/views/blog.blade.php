<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightbox.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/alertify.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/alertify.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/plugins.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/slick.css')}}" rel="stylesheet">


	{{-- <link href="{{asset('public/frontend/css/alertify.rtl.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/alertify.rtl.min.css')}}" rel="stylesheet"> --}}
	<link rel="icon" href="{{asset('public/frontend/images/logofm.png')}}">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    {{-- <link rel="shortcut icon" href="{{('images/ico/favicon.ico')}} "> --}}
    

<body>
	@csrf
	<div class="navi"> 
		<!--menu-bar----------------------------------------->
		<div class="navigation">
			<!--logo------------>
			<a href="{{url('/')}}" class="logo"><img src="{{asset('public/frontend/images/foneemobilelogo_final.png')}}" alt="" /></a>	
			<!--menu-icon------------->
			<div class="toggle"></div>
			<!--menu----------------->
			<ul class="menu">
				<li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
				<li ><a href="{{url('/product')}}" ><i class="fa fa-anchor" aria-hidden="true"></i> Sản phẩm</a></li>
				<li><a href="{{url('/blog')}}"><i class="fa fa-book" aria-hidden="true"></i> Tin tức</a>
				</li>
				<li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> Liên hệ</a></li>

			</ul>
			<!--right-menu----------->
			<div class="right-menu" >
				<a href="javascript:void(0);" class="search">
					<i class="fa fa-search"></i>
				</a>
				<a href="" class="user dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					<i class="fa fa-user"></i>
				</a>
				<ul class="dropdown-menu fix-sub-menu">
					<!-- User image -->
					<li class="user-header sub-menu" role="menu">
						<?php 
							$customer_id = Session::get('customer_id');
							if($customer_id != null){
							?>
								<a href="{{URL::to('/logout')}}"><i class="fa fa-sign-in"></i> Đăng xuất</a>
								<a href="{{route('customer.history')}}"><i class="fa fa-repeat"></i> Lịch sử</a>
							<?php
							}
							else {
							?>
								<a href="{{url('/login')}}"><i class="fa fa-plus"></i> Đăng ký</a>
								<a href="{{URL::to('/login')}}"><i class="fa fa-sign-in"></i> Đăng nhập</a>
								
							<?php
							}
								
						?> 
					</li>
					<!-- Menu Body -->
					
					
				  </ul>
				<?php 
					$customer_id = Session::get('customer_id');
					$shipping_id = Session::get('shipping_id');
				?>
				<?php
					$cart = Session::get('cart');
					if(isset($cart)){ 
					?>
						<a href="{{URL::to('/cart')}}">
							<i class="fa fa-shopping-cart">
								<span class="num-cart-product">{{count($cart)}}</span>
							</i>
						</a>
					<?php
					}
					else{?>
						<a href="{{URL::to('/cart')}}">
							<i class="fa fa-shopping-cart">
								<span class="num-cart-product">0</span>
							</i>
						</a>	
					<?php
					}
				?>
				
			</div>
		</div>
	</div>
	<?php
		 $message = Session::get('message');
		 $message_error = Session::get('message_error');
            if($message){
            ?> 
                <div class="alert alert-success alert-dismissible" style="right: 14px;position: absolute;top:0;z-index:9999">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ $message }}
					{{Session::put('message', null)}}
                </div>
                                    
            <?php
			}
			if($message_error){
            ?> 
                <div class="alert alert-danger alert-dismissible" style="right: 14px;position: absolute;top:0;z-index:9999">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ $message_error }}
					{{Session::put('message_error', null)}}
                </div>
                                    
            <?php
        	}              
		 ?>
		 <?php
			 $customer_active = Session::get('customer_active');
            if($customer_active == 1){
            ?> 
                <div class="alert alert-danger alert-dismissible" style="right: 14px;position: absolute;top:0; z-index:9999">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<p>Vui lòng kiểm tra email của bạn để kích hoạt tài khoản!</p>
					{{Session::put('customer_active', null)}}
                </div>
                                    
            <?php
        	}         
		 ?>
	 <!--search-bar----------------------------------->
	 <form action="{{URL::to('/search')}}" method="GET" style="position:fixed;z-index: 10000;">
	 <div class="search-bar">	
        <!--search-input------->
        <div class="search-input">	
			<input type="text" placeholder="" name="tu_khoa" id="key" autocomplete="off"/>
        <!--cancel-btn--->
	
        <a href="javascript:void(0);" class="search-cancel">
            <i class="fa fa-times"></i>
        </a>
	
    	</div>
	
    </div>
	</form>
	<div id="searchajax" class="search-ajaxx">
				
	</div>
	<section class="fix-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12 padding-right">
					
					@yield('content')
					
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="left-sidebar">						
						<div class="brands_products"><!--brands_products-->			
							<div class="brands-name">
								<div class="sidebar_widget">
									<div class="widget-title"><h2>Tin tức nổi bật<i class="fa fa-book"></i></h2></div>
									<div class="widget-content">
										<div class="list list-sidebar-products">
										  <div class="grid">
											@foreach ($blog_popular as $pop)
											<div class="grid__item">
												<div class="mini-list-item">
												  <div class="mini-view_image"> <a class="grid-view-item__link" href="{{URL::to('blog/'.$pop->blog_slug)}}"><img class="grid-view-item__image" src="{{URL::to('public/uploads/product/'.$pop->blog_thumb)}}" alt="" /></a> </div>
												  <div class="details"> <a class="grid-view-item__title" href="{{URL::to('blog/'.$pop->blog_slug)}}">{{$pop->blog_title}}</a>
													<div class="grid-view-item__meta"><i style="font-size: 13px"><i class="fa fa-clock-o"></i> {{date_format($pop->created_at,'d/m/y H:i')}}</i></div>
												  </div>
												</div>
											  </div>
											@endforeach
											
											
										  </div>
										</div>
									  </div>
								</div>
								<!--End Popular Products-->
							</div>
						</div><!--/brands_products-->
						<div class="brands_products"><!--brands_products-->			
							<div class="brands-name">
								<div class="sidebar_widget">
									<div class="widget-title"><h2>Sản phẩm nổi bật <i class="fa fa-shopping-cart"></i></h2></div>
									<div class="widget-content">
										<div class="list list-sidebar-products">
										  <div class="grid">
											@foreach ($popular_product as $pop)
											<div class="grid__item">
												<div class="mini-list-item">
												  <div class="mini-view_image"> <a class="grid-view-item__link" href="{{URL::to('product/'.$pop->product_slug)}}"><img class="grid-view-item__image" src="{{URL::to('public/uploads/product/'.$pop->product_image)}}" alt="" /></a> </div>
												  <div class="details"> <a class="grid-view-item__title" href="{{URL::to('product/'.$pop->product_slug)}}">{{$pop->product_name}}</a>
													<div class="grid-view-item__meta"><span class="product-price__price"><span class="money">{{number_format($pop->product_price, 0, '.','.') }} Đ</span></span></div>
												  </div>
												</div>
											  </div>
											@endforeach
											
											
										  </div>
										</div>
									  </div>
								</div>
								<!--End Popular Products-->
							</div>
						</div><!--/brands_products-->
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
	<section class="services">
        <!--services-box---------->
        <div class="services-box">
            <i class="icon fa fa-truck"></i>
            <span>Vận chuyển miễn phí</span>
            <p>Giao hàng miễn phí các đơn hàng trong nước</p>
        </div>
        <!--services-box---------->
        <div class="services-box">
            <i class="icon fa fa-comments"></i>
            <span>Hỗ trợ trực tuyến</span>
            <p>Chúng tôi hỗ trợ trực tuyến 24/7 trong ngày</p>
        </div>
        <!--services-box---------->
        <div class="services-box">
            <i class="icon fa fa-usd"></i>
            <span>Hoàn tiền</span>
            <p>Đảm bảo hoàn tiền trong 30 ngày mua hàng</p>
        </div>
		<div class="services-box">
            <i class="icon fa fa-credit-card"></i>
            <span>Thanh toán an toàn</span>
            <p>Tất cả các khoản thanh toán đều được bảo đảm</p>
        </div>
        
    </section>
	<footer class="footer clearfix">
		<div class="footer-bg">
			<div class="ft widget widget-links">
				<p>THÔNG TIN VỀ CHÚNG TÔI</p>
				<ul>
					<li><a href="">Về chúng tôi</a></li>
					<li><a href="">Hình thức mua hàng</a></li>
					<li><a href="">Hình thức thanh toán</a></li>
					<li><a href="">Chính sách bảo mật</a></li>
					<li><a href="">Tư vấn</a></li>
				 </ul>
			</div>
			<div class="ft widget widget-links">
				<p>HỢP TÁC VÀ LIÊN KẾT</p>
				<ul>
					<li><a href="">Quy chế hoạt động sàn GDTMDT</a></li>
					<li><a href="">Bán hàng cùng chúng tôi</a></li>                      
				 </ul>
				 <div class="ship">
					<img src="{{asset('public/frontend/images/ninja.png')}}" alt="">
					<img src="{{asset('public/frontend/images/ghn.png')}}" alt="">
					<img src="{{asset('public/frontend/images/shopee.png')}}" alt="">
				</div>
			</div>
			<div class="ft widget widget-links">
				<p>TỔNG ĐÀI HỖ TRỢ (GỌI MIỄN PHÍ)</p>
				<ul>
					<li><a href="">Mua hàng 1800.1061 (7:30 - 22:00)</a></li>
					<li><a href="">Kỹ thuật 1800.1764 (7:30 - 22:00)</a></li>
					<li><a href="">Bảo hành 1800.1764 (7:30 - 22:00)</a></li>
					<li><a href="">Khiếu nại 1800.1764 (7:30 - 22:00)</a></li>
				 </ul>
			</div>
			<div class="ft widget widget-links">
				<p>LIÊN HỆ</p>
				<address>
					<img src="{{asset('public/frontend/images/pre_footer_address_icon.png')}}">
					<span>Hương Thủy - TT Huế</span> <br>
					<img src="{{asset('public/frontend/images/pre_footer_phone_icon.png')}}">
					<a href="">CSKH: 0967074504</a> <br>
					<img src="{{asset('public/frontend/images/pre_footer_email_icon.png')}}">
					<a href="">foneeshoplaravel@gmail.com</a>
					<br>
					<img src="{{asset('public/frontend/images/foneemobilelogo_final.png')}}" alt="">
				 </address>
			</div>
			<div class="copy">	
			  © Copyright 2020 by PHUCPHON
		   </div>
		</div>
	</footer>
	<script src="{{asset('public/frontend/js/frontend.js')}}"></script>
	<script type="text/javascript">

		$(document).ready(function () {
		
		window.setTimeout(function() {
			$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
				$(this).remove(); 
			});
		}, 3000);
		
		});
	</script>
	<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery2.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/jquery.prettyPhoto.js')}}"></script>
	<script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/slick.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightbox.min.js')}}"></script>

	<script src="{{asset('public/frontend/js/lightbox.js')}}"></script>
	<script src="{{asset('public/frontend/js/type.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('li a').on('click', function(){
				$(this).siblings().removeClass('active');
				$(this).addClass('active');
			});
		});
	</script>
	<script type="text/javascript">
		// function handleColor(self){
		// 	var colorid = self.getAttribute("data-color");
            $('.add-to-cart').click(function (){
				
                var id = $(this).data('product_id');
				// var idcolor = $('#pickcolor').data('color');
				// var colorid = this.getAttribute("data-color").val();
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_slug = $('.cart_product_slug_' + id).val();
				// var cart_product_color = $('.cart_product_color_' + colorid).val();
				var cart_product_color = $('input[name="check-color"]:checked').val();
				var cart_product_id_color = cart_product_id+'_'+cart_product_color;
				// var cart_product_memory = $('.cart_product_memory_' + memoryid).val();
				var cart_product_memory = $('input[name="check-memory"]:checked').val();
				var cart_product_id_memory = cart_product_id+'_'+cart_product_memory;
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_slug:cart_product_slug
					,cart_product_color:cart_product_color,cart_product_id_color:cart_product_id_color,cart_product_memory:cart_product_memory,cart_product_id_memory:cart_product_id_memory,cart_product_qty:cart_product_qty,_token:_token},
                    success:function(response){
						$('.num-cart-product').text(response.count);
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
								type: "success",
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/cart')}}";
                            });

                    }

                });
            });
		// }
    </script>
	<script>
		$(document).ready(function () {
			$('.increment-btn').click(function (e) {
				e.preventDefault();
				var incre_value = $(this).parents('.quantity').find('.qty-input').val();
				var value = parseInt(incre_value, 10);
				value = isNaN(value) ? 0 : value;
				if(value<10){
					value++;
					$(this).parents('.quantity').find('.qty-input').val(value);
				}

			});

			$('.decrement-btn').click(function (e) {
				e.preventDefault();
				var decre_value = $(this).parents('.quantity').find('.qty-input').val();
				var value = parseInt(decre_value, 10);
				value = isNaN(value) ? 0 : value;
				if(value>1){
					value--;
					$(this).parents('.quantity').find('.qty-input').val(value);
				}
			});

		});
	</script>
	<script>
		// Update Cart Data
		$(document).ready(function () {
			$('.changeQuantity').click(function (e) {
				e.preventDefault();
				var $thisClick = $(this);
				var quantity = $(this).closest(".cartpage").find('.qty-input').val();
				var session_id = $(this).closest(".cartpage").find('.session-id').val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/update-cart-product')}}',
					type: 'post',
					data: {quantity:quantity, session_id:session_id,_token:_token},				
					success: function (response) {
						 $thisClick.closest('.cartpage').find('.cart_total_sub').text(response.money);
						 $('.cart-total').find('.cart_total_price').text(response.total);
						//  location.reload(true);
					}
				});
			});

		});
	</script>
	<script>
		// Delele  Cart sesionid Data
		$(document).ready(function () {
			$('.cart_quantity_delete').click(function (e) {
				e.preventDefault();
				let urlRequest = $(this).data('url');
				let that = $(this);
				$.ajax({
					url: urlRequest,
					type: 'get',					
					success: function (response) {
						if(response.code == 200){						
							// swal("OK!", response.message, "success");	
							that.parent().parent().remove();//Xóa table
							 $('.cart-total').find('.cart_total_price').text(response.total);
							 $('.num-cart-product').text(response.count);
							// location.reload(true);	
						}
					}
				});
			});

		});
	</script>
	<script>
		// Delele  all Cart Data
		$(document).ready(function () {
			$('.delete-all-cart').click(function (e) {
				e.preventDefault();
				$.ajax({
					url: '{{url('/delete-all-cart-ajax')}}',
					type: 'get',					
					success: function (response) {
						if(response.code == 200){						
							swal("OK!", response.message, "success");	
							$('.cart_info').remove();//Xóa table
							location.reload(true);	
						}
					}
				});
			});

		});
	</script>

	<script>
		$(function(){
			$('.orderby').change(function(){
				$("#form_order").submit();
			});
		});
	</script>
	<script>
		var typed = new Typed('#key',{
			strings: [
				'Bạn muốn tìm kiếm gì?',
				'Samsung Galaxy S20',
				'iphone 12 Pro Max',
				'Xiaomi Redmi Note 10'
			],
			typeSpeed :40,
			backSpeed :40,
			attr : 'placeholder',
			bindInputFocusEvents : true,
			loop : true
		});
	</script>
	<script>
		$(window).scroll(function(){
			let position= $(this).scrollTop();
			// console.log(position);
			if(position >=10){
				$('.navigation').addClass('fix-nav');
				
			}
			else{
				$('.navigation').removeClass('fix-nav');
				
			}
    	});
		// $(window).scroll(function(){
		// 	var sticky = $('.'),
		// 		scroll = $(window).scrollTop();

		// 	if (scroll >= 100) sticky.addClass('fixed-top');
		// 	else sticky.removeClass('fixed-top');
		// });
	</script>
	<script>
		var slideIndex = 1;
		showSlides(slideIndex);

		function plusSlides(n) {
		showSlides(slideIndex += n);
		}

		function currentSlide(n) {
		showSlides(slideIndex = n);
		}

		function showSlides(n) {
		var i;
		var slides = document.getElementsByClassName("view-product");
		var dots = document.getElementsByClassName("demo");
		if (n > slides.length) {slideIndex = 1}
		if (n < 1) {slideIndex = slides.length}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex-1].style.display = "block";
		dots[slideIndex-1].className += " active";
		}

		
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.responsive').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 2000,
				responsive: [
					{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3						
					}
					},
					{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
					},
					{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					}
					
				]
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.center').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				autoplay: false,
				autoplaySpeed: 2000,
				responsive: [
					{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3						
					}
					},
					{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
					},
					{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					}
					
				]
			});
		});
	</script>
	<script type="text/javascript">
		function cong(){
			var t = document.getElementById("soluong").value;
			document.getElementById("soluong").value = parseInt(t) + 1;
		}
		function tru(){
			var t = document.getElementById("soluong").value;
			if(parseInt(t)>1){
				document.getElementById("soluong").value = parseInt(t) - 1;
			}
			
		}
	</script>
	<script>
		$(document).ready(function(){
			$('cart_quantity_input').on('change', function(){
				var cart_qty = $(".cart_quantity_input").val();
				
				$.ajax({	
					url: '{{url('/update-cart')}}',
					method: 'POST',
					cache: false,
					data : {cart_qty:cart_qty}
					success: function(response){
						location.reload(true);
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.choose').on('change', function(){
				var action = $(this).attr('id');
				var id = $(this).val();
				var _token = $('input[name="_token"]').val();
				var result = '';
				if(action == 'city'){
					result = 'district';
				}else{
					result ='ward';
				}
				$.ajax({
					url: '{{url('/select-city')}}',
					method: 'POST',
					data: {action:action,id:id,_token:_token},
					success:function(data){
						$('#'+result).html(data);
					}
				});
			});
		});
	</script>
	{{-- <script>
		function showReplyForm(self) {
			var commentId = self.getAttribute("data-comment-id");
			if (document.getElementById("form-" + commentId).style.display == "none") {
				document.getElementById("form-" + commentId).style.display = "block";
			} else {
				document.getElementById("form-" + commentId).style.display = "none";
			}
			// var x = document.getElementById("form-"+ commentId);
			// if (x.style.display === "none") {
			// 	x.style.display = "block";
			// } else {
			// 	x.style.display = "none";
			// }
		}
		
	</script> --}}
	<script>
		function showReplyForReplyForm(self) {
			var commentId = self.getAttribute("data-comment-id");
			var name = self.getAttribute("data-name");
		
			if (document.getElementById("form-" + commentId).style.display == "") {
				document.getElementById("form-" + commentId).style.display = "none";
			} else {
				document.getElementById("form-" + commentId).style.display = "";
			}
		
			document.querySelector("#form-" + commentId + " textarea[name=comment_reply_content]").value =  "@" + name;
			document.getElementById("form-" + commentId).scrollIntoView({behavior: "smooth", block: "end"});
		}
	</script>
	<script>
		$("#key").keyup(function(){
			var query = $(this).val();
			if(query != ''){
			    var _token = $('input[name="_token"]').val();
				$.ajax({
					url : '{{url('/autocomplete-ajax')}}',
					method: 'POST',
					data : {query:query,_token:_token},
					success:function(data){
						$('#searchajax').fadeIn();
						$('#searchajax').html(data);
						
					}
				});
			}else{
				$('#searchajax').fadeOut();
			}
		});
		$('#searchajax').on('click','li', function(){
			$('#key').val($(this).text());
			$('#searchjax').fadeOut();
		});
	</script>
	<script>
		$(document).on('click','.search',function(){
			$('.search-bar').addClass('search-bar-active')
			// $('.menu').fadeOut();
		});
	
		$(document).on('click','.search-cancel',function(){
			$('.search-bar').removeClass('search-bar-active')
			$('.search-ajaxx').fadeOut();
			// $('.menu').fadeIn();

		});
	</script>
	<script>
		$(document).ready(function(){
			$('.toggle').click(function(){
				$('.toggle').toggleClass('active')
				$('.navigation').toggleClass('active')
			})
		});
	</script>
	@yield('script')
</body>
</html>