
<title>
   Tin tức về công nghệ
</title>
<?php $__env->startSection('content'); ?>
<div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
    <div class="blog--list-view">
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>">Trang chủ</a></li>
            <li style="color: red">Bài viết</li>
          </ul>
        <div class="row">
            <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                <!-- Article Image --> 
                 <a class="article_featured-image" href="<?php echo e(url('/blog/'.$blog->blog_slug)); ?>"><img class="blur-up ls-is-cached lazyloaded"  src="<?php echo e(asset('/public/uploads/product/'.$blog->blog_thumb)); ?>"></a> 
                <h3 class="h3"><a href="<?php echo e(url('/blog/'.$blog->blog_slug)); ?>"><?php echo e($blog->blog_title); ?></a></h3>
                <ul class="publish-detail">                      
                    <li><i class="fa fa-user" aria-hidden="true"></i>  <?php echo e($blog->users->name); ?></li>
                    <li><i class="fa fa-clock-o"></i> <?php echo e(date_format($blog->created_at,'d/m/y/ H:i')); ?></li>
                </ul>
                
                
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
    </div>
</div>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
      <?php echo e($all_blog->appends(Request::all())->links()); ?>

    </ul>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\foneemobile\resources\views/pages/blog/show_blog.blade.php ENDPATH**/ ?>