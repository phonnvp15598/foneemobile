<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="<?php echo e(asset('public/frontend/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/frontend/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/frontend/css/prettyPhoto.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/frontend/css/price-range.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/frontend/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/frontend/css/main.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/frontend/css/responsive.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/frontend/css/sweetalert.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/frontend/css/lightbox.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/frontend/css/alertify.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/frontend/css/alertify.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/frontend/css/style.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/frontend/css/plugins.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('public/frontend/css/slick.css')); ?>" rel="stylesheet">


	
	<link rel="icon" href="<?php echo e(asset('public/frontend/images/logofm.png')); ?>">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    
    

<body>
	<?php echo csrf_field(); ?>
	<div class="navi"> 
		<!--menu-bar----------------------------------------->
		<div class="navigation">
			<!--logo------------>
			<a href="<?php echo e(url('/')); ?>" class="logo"><img src="<?php echo e(asset('public/frontend/images/foneemobilelogo_final.png')); ?>" alt="" /></a>	
			<!--menu-icon------------->
			<div class="toggle"></div>
			<!--menu----------------->
			<ul class="menu">
				<li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home" aria-hidden="true"></i> Trang ch???</a></li>
				<li ><a href="<?php echo e(url('/product')); ?>" ><i class="fa fa-anchor" aria-hidden="true"></i> S???n ph???m</a></li>
				<li><a href="<?php echo e(url('/blog')); ?>"><i class="fa fa-book" aria-hidden="true"></i> Tin t???c</a>
				</li>
				<li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> Li??n h???</a></li>
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
								<a href="<?php echo e(URL::to('/logout')); ?>"><i class="fa fa-sign-in"></i> ????ng xu???t</a>
								<a href="<?php echo e(route('customer.history')); ?>"><i class="fa fa-repeat"></i> L???ch s???</a>
							<?php
							}
							else {
							?>
								<a href="<?php echo e(url('/login')); ?>"><i class="fa fa-plus"></i> ????ng k??</a>
								<a href="<?php echo e(URL::to('/login')); ?>"><i class="fa fa-sign-in"></i> ????ng nh???p</a>
								
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
						<a href="<?php echo e(URL::to('/cart')); ?>">
							<i class="fa fa-shopping-cart">
								<span class="num-cart-product"><?php echo e(count($cart)); ?></span>
							</i>
						</a>
					<?php
					}
					else{?>
						<a href="<?php echo e(URL::to('/cart')); ?>">
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
					<?php echo e($message); ?>

					<?php echo e(Session::put('message', null)); ?>

                </div>
                                    
            <?php
			}
			if($message_error){
            ?> 
                <div class="alert alert-danger alert-dismissible" style="right: 14px;position: absolute;top:0;z-index:9999">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo e($message_error); ?>

					<?php echo e(Session::put('message_error', null)); ?>

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
					<p>Vui l??ng ki???m tra email c???a b???n ????? k??ch ho???t t??i kho???n!</p>
					<?php echo e(Session::put('customer_active', null)); ?>

                </div>
                                    
            <?php
        	}         
		 ?>
	 <!--search-bar----------------------------------->
	 <form action="<?php echo e(URL::to('/search')); ?>" method="GET" style="position:fixed;z-index: 10000;">
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
				<div class="col-sm-12 fix-notfound">
					
					<?php echo $__env->yieldContent('content'); ?>
					
				</div>
				
			</div>
		</div>
	</section>
	
	<section class="services">
        <!--services-box---------->
        <div class="services-box">
            <i class="icon fa fa-truck"></i>
            <span>V???n chuy???n mi???n ph??</span>
            <p>Giao h??ng mi???n ph?? c??c ????n h??ng trong n?????c</p>
        </div>
        <!--services-box---------->
        <div class="services-box">
            <i class="icon fa fa-comments"></i>
            <span>H??? tr??? tr???c tuy???n</span>
            <p>Ch??ng t??i h??? tr??? tr???c tuy???n 24/7 trong ng??y</p>
        </div>
        <!--services-box---------->
        <div class="services-box">
            <i class="icon fa fa-usd"></i>
            <span>Ho??n ti???n</span>
            <p>?????m b???o ho??n ti???n trong 30 ng??y mua h??ng</p>
        </div>
		<div class="services-box">
            <i class="icon fa fa-credit-card"></i>
            <span>Thanh to??n an to??n</span>
            <p>T???t c??? c??c kho???n thanh to??n ?????u ???????c b???o ?????m</p>
        </div>
        
    </section>
	<footer class="footer clearfix">
		<div class="footer-bg">
			<div class="ft widget widget-links">
				<p>TH??NG TIN V??? CH??NG T??I</p>
				<ul>
					<li><a href="">V??? ch??ng t??i</a></li>
					<li><a href="">H??nh th???c mua h??ng</a></li>
					<li><a href="">H??nh th???c thanh to??n</a></li>
					<li><a href="">Ch??nh s??ch b???o m???t</a></li>
					<li><a href="">T?? v???n</a></li>
				 </ul>
			</div>
			<div class="ft widget widget-links">
				<p>H???P T??C V?? LI??N K???T</p>
				<ul>
					<li><a href="">Quy ch??? ho???t ?????ng s??n GDTMDT</a></li>
					<li><a href="">B??n h??ng c??ng ch??ng t??i</a></li>                      
				 </ul>
				 <div class="ship">
					<img src="<?php echo e(asset('public/frontend/images/ninja.png')); ?>" alt="">
					<img src="<?php echo e(asset('public/frontend/images/ghn.png')); ?>" alt="">
					<img src="<?php echo e(asset('public/frontend/images/shopee.png')); ?>" alt="">
				</div>
			</div>
			<div class="ft widget widget-links">
				<p>T???NG ????I H??? TR??? (G???I MI???N PH??)</p>
				<ul>
					<li><a href="">Mua h??ng 1800.1061 (7:30 - 22:00)</a></li>
					<li><a href="">K??? thu???t 1800.1764 (7:30 - 22:00)</a></li>
					<li><a href="">B???o h??nh 1800.1764 (7:30 - 22:00)</a></li>
					<li><a href="">Khi???u n???i 1800.1764 (7:30 - 22:00)</a></li>
				 </ul>
			</div>
			<div class="ft widget widget-links">
				<p>LI??N H???</p>
				<address>
					<img src="<?php echo e(asset('public/frontend/images/pre_footer_address_icon.png')); ?>">
					<span>H????ng Th???y - TT Hu???</span> <br>
					<img src="<?php echo e(asset('public/frontend/images/pre_footer_phone_icon.png')); ?>">
					<a href="">CSKH: 0967074504</a> <br>
					<img src="<?php echo e(asset('public/frontend/images/pre_footer_email_icon.png')); ?>">
					<a href="">foneeshoplaravel@gmail.com</a>
					<br>
					<img src="<?php echo e(asset('public/frontend/images/foneemobilelogo_final.png')); ?>" alt="">
				 </address>
			</div>
			<div class="copy">	
			  ?? Copyright 2020 by PHUCPHON
		   </div>
		</div>
	</footer>
	<script src="<?php echo e(asset('public/frontend/js/frontend.js')); ?>"></script>
	<script type="text/javascript">

		$(document).ready(function () {
		
		window.setTimeout(function() {
			$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
				$(this).remove(); 
			});
		}, 3000);
		
		});
	</script>
	<script src="<?php echo e(asset('public/frontend/js/jquery.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/jquery2.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/jquery.scrollUp.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/price-range.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/jquery.prettyPhoto.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/main.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/sweetalert.min.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/slick.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/lightbox.min.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/lightbox.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/type.js')); ?>"></script>
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
                    url: '<?php echo e(url('/add-cart-ajax')); ?>',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_slug:cart_product_slug
					,cart_product_color:cart_product_color,cart_product_id_color:cart_product_id_color,cart_product_memory:cart_product_memory,cart_product_id_memory:cart_product_id_memory,cart_product_qty:cart_product_qty,_token:_token},
                    success:function(response){
						$('.num-cart-product').text(response.count);
                        swal({
                                title: "???? th??m s???n ph???m v??o gi??? h??ng",
                                text: "B???n c?? th??? mua h??ng ti???p ho???c t???i gi??? h??ng ????? ti???n h??nh thanh to??n",
                                showCancelButton: true,
								type: "success",
                                cancelButtonText: "Xem ti???p",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "??i ?????n gi??? h??ng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "<?php echo e(url('/cart')); ?>";
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
					url: '<?php echo e(url('/update-cart-product')); ?>',
					type: 'post',
					data: {quantity:quantity, session_id:session_id,_token:_token},				
					success: function (response) {
						 $thisClick.closest('.cartpage').find('.cart_total_sub').text(response.money);
						 $('.cart-total').find('.cart_total_price').text(response.total);
						 $('.total-checkout').text(response.total);
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
							that.parent().parent().remove();//X??a table
							 $('.cart-total').find('.cart_total_price').text(response.total);
							 $('.num-cart-product').text(response.count);
							 $('.total-checkout').text(response.total);
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
					url: '<?php echo e(url('/delete-all-cart-ajax')); ?>',
					type: 'get',					
					success: function (response) {
						if(response.code == 200){						
							swal("OK!", response.message, "success");	
							$('.cart_info').remove();//X??a table
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
				'B???n mu???n t??m ki???m g???',
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
					url: '<?php echo e(url('/update-cart')); ?>',
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
					url: '<?php echo e(url('/select-city')); ?>',
					method: 'POST',
					data: {action:action,id:id,_token:_token},
					success:function(data){
						$('#'+result).html(data);
					}
				});
			});
		});
	</script>
	
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
					url : '<?php echo e(url('/autocomplete-ajax')); ?>',
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
	<?php echo $__env->yieldContent('script'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\foneemobile\resources\views/404.blade.php ENDPATH**/ ?>