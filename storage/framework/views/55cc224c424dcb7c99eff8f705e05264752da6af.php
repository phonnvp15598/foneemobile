
<title>
    Đăng nhập tài khoản
</title>
<?php $__env->startSection('content'); ?>
<section id=""><!--form-->
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="<?php echo e(URL::to('/login')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="text" name="customer_email" placeholder="Tài khoản email" />
                        <input type="password" name="customer_password" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                    <a href="<?php echo e(URL::to('/reset-password')); ?>">Quên mật khẩu</a>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký tài khoản</h2>
                    <form action="<?php echo e(URL::to('/register-customer')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="text" placeholder="Họ tên" name="customer_name" value="<?php echo e(old('customer_name')); ?>" />
                        <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="badge btn-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="text" placeholder="Địa chỉ email" name="customer_email" value="<?php echo e(old('customer_email')); ?>"/>
                        <?php $__errorArgs = ['customer_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="badge btn-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="password" placeholder="Mật khẩu" name="customer_password" value="<?php echo e(old('customer_password')); ?>"/>
                        <?php $__errorArgs = ['customer_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="badge btn-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
</section><!--/form-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\foneemobile\resources\views/pages/customer/login.blade.php ENDPATH**/ ?>