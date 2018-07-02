<?php $__env->startSection('content'); ?>
<!-- PRODUCT SECTION START -->
<section class="product-section ptb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row display-flex">
            <?php $__empty_1 = true; $__currentLoopData = $new_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            	<?php if($key == 1): ?>
            	<div class="col-md-4 col-sm-6 col-xs-12">
            		<div class="single-post">
	            		<h2 class="title"> Sản phẩm <span>mới</span> </h2>
	            		<p class="desc"><?php echo e($single_post->description); ?></p>
	            		<p class="image"><img src="<?php echo e(( $single_post->image && file_exists(public_path('/uploads/pages/'.$single_post->image)) ? asset( 'public/uploads/pages/'.get_thumbnail($single_post->image, '_small') ) : asset('noimage/370x230') )); ?>"></p>
            		</div>
            	</div>
            	<?php endif; ?>
            	<?php echo get_template_product($val,'san-pham',3); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- PRODUCT SECTION END -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>