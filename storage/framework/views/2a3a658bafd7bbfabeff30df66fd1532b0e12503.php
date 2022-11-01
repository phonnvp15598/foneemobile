
<div class="render-product">

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
  
    <div class="box-footer clearfix">
        <?php if(Request::route()->getName() == 'pages.product'): ?>
                
            <ul class="pagination pagination-sm no-margin pull-right">
                <?php echo $all_product->appends($query ?? [])->links(); ?>

            </ul>
        <?php endif; ?>
    </div>
</div> 
<?php /**PATH C:\xampp\htdocs\foneemobile\resources\views/pages/product/productajax.blade.php ENDPATH**/ ?>