
<title>
    Giỏ hàng của bạn
</title>
<?php $__env->startSection('content'); ?>
<section id="cart_items">
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">Trang chủ</a></li>
        <li style="color: red">Giỏ hàng của bạn</li>
      </ul>
    
    <?php if(Session::get('cart')==true): ?>
    <div class="table-responsive cart_info box-body no-padding">
        <form action="<?php echo e(url('/update-cart')); ?>" method="POST">
            <?php echo csrf_field(); ?>
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
                <?php
                    $total = 0;
                ?>
                <?php $__currentLoopData = Session::get('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                    <?php
                        $subtotal = $cart['product_qty']*$cart['product_price'];
                        $total += $subtotal;
                    ?>
                    <tr class="cartpage">
                        <input type="hidden" class="session-id" value="<?php echo e($cart['session_id']); ?>">
                        <input type="hidden" class="pprice" value="<?php echo e($cart['product_price']); ?>">
                        <td class="cart_product">
                            <a href="<?php echo e(URL::to('product/'.$cart['product_slug'])); ?>"><img src="<?php echo e(URL::to('/public/uploads/product/'.$cart['product_image'])); ?>" alt="" width="75px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href=""><?php echo e($cart['product_name']); ?></a></h4>
                            <p></p>
                        </td>
                        <td class="cart_color">
                            <p><?php echo e($cart['product_color']); ?></p>
                        </td>
                        <td class="cart_memory">
                            <p><?php echo e($cart['product_memory']); ?></p>
                        </td>
                        <td class="cart_price">
                            <p><?php echo e(number_format($cart['product_price'], 0, '.','.')); ?> Đ</p>
                        </td>
                        <td class="cart_quantity">
                                <span class="new-cart-quantity quantity">
                                    <input value="-" class="decrement-btn changeQuantity">
                                    <input class="qty-input"   value="<?php echo e($cart['product_qty']); ?>"   name="cart_qty[<?php echo e($cart['session_id']); ?>]" size="3">
                                    <input value="+" class="increment-btn changeQuantity">
                                </span>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_sub"><?php echo e(number_format($subtotal, 0, '.','.')); ?> Đ</p>
                        </td>
                        <td class="cart_delete">
                            
                            <a class="cart_quantity_delete" data-url="<?php echo e(url('/delete-cart-ajax/'.$cart['session_id'])); ?>" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                   
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="cart-total">
                    <td colspan="6" align="right" style="font-weight: bold;">Tổng cộng: </td>
                    <th class="cart_total_price"><?php echo number_format($total, 0, '.','.') .' Đ'?></th>
                </tr>
               <tr>
                   
                   
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
                                <a href="<?php echo e(URL::to('/checkout')); ?>" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                            <?php
                            }elseif($customer_id != null && $shipping_id != null){
                            ?>
                                <a href="<?php echo e(URL::to('/checkout')); ?>" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                            <?php
                            }else{
                            ?>
                                <a href="<?php echo e(URL::to('/login')); ?>" class="btn btn-default btn-sm check_out"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                            <?php
                            }					
                        ?>
                    </div>
                </div>
            </div>
        </div>    
        </form>
        
    </div>
    
    <?php else: ?>
    <div class="alert alert-success">Giỏ hàng đang trống!
        
    </div>
    <div class="cart-empty"><img src="<?php echo e(asset('/public/frontend/images/empty-cart.png')); ?>" alt=""></div>
    <?php endif; ?>     
    
</section> <!--/#cart_items-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('404', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\foneemobile\resources\views/pages/cart/show_cart_ajax.blade.php ENDPATH**/ ?>