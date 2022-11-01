
<title>Fonee Mobile</title>
<?php $__env->startSection('content'); ?>
<div class="features_items"><!--features_items-->
    <div class="row">
        <div class="col-sm-8"> <h2 class="title text-center">Danh sách sản phẩm</h2></div>
        <div class="col-sm-4">
            <div class="sort-by ">
                <form method="get" id="form_order">
                    <select name="orderby" class="orderby">
                        <option <?php echo e(Request::get('orderby')== "md" ? "selected='selected'" : ""); ?> value="md" selected="selected">Mặc định</option>
                        <option <?php echo e(Request::get('orderby')== "new" ? "selected='selected'" : ""); ?> value="new">Mới nhất</option>
                        <option <?php echo e(Request::get('orderby')== "old" ? "selected='selected'" : ""); ?> value="old">Cũ nhất</option>
                        <option <?php echo e(Request::get('orderby')== "price-asc" ? "selected='selected'" : ""); ?> value="price-asc">Giá: Tăng dần</option>
                        <option <?php echo e(Request::get('orderby')== "price-desc" ? "selected='selected'" : ""); ?> value="price-desc">Giá: Giảm dần</option>
                        <option <?php echo e(Request::get('orderby')== "name-asc" ? "selected='selected'" : ""); ?> value="name-asc">Tên: A-Z</option>
                        <option <?php echo e(Request::get('orderby')== "name-desc" ? "selected='selected'" : ""); ?> value="name-desc">Tên: Z-A</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <?php $__currentLoopData = $all_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $all): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" value="<?php echo e($all->product_id); ?>" class="cart_product_id_<?php echo e($all->product_id); ?>">
                                    <input type="hidden" value="<?php echo e($all->product_name); ?>" class="cart_product_name_<?php echo e($all->product_id); ?>">
                                    <input type="hidden" value="<?php echo e($all->product_image); ?>" class="cart_product_image_<?php echo e($all->product_id); ?>">
                                    <input type="hidden" value="<?php echo e($all->product_price); ?>" class="cart_product_price_<?php echo e($all->product_id); ?>">
                                    <input type="hidden" value="<?php echo e($all->product_slug); ?>" class="cart_product_slug_<?php echo e($all->product_id); ?>">
                                    <input type="hidden" value="1" class="cart_product_qty_<?php echo e($all->product_id); ?>">
                                    <a href="<?php echo e(URL::to('product/'.$all->product_slug)); ?>">
                                        <div class="fix-anh"><img src="<?php echo e(URL::to('public/uploads/product/'.$all->product_image)); ?>" alt="" class="thumb"/></div>
                                    </a>
                                    <h2><?php echo e(number_format($all->product_price, 0, '.','.')); ?> Đ</h2>
                                    <p style="text-transform: uppercase"><?php echo e($all->product_name); ?></p>
                                    
                                        
                                        
                                    
                                </form>                 
                            </div>
                    </div>
                    
                </div>
            </div>
      
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
      <?php echo e($all_product->appends(Request::all())->links()); ?>

    </ul>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\foneemobile\resources\views/pages/home.blade.php ENDPATH**/ ?>