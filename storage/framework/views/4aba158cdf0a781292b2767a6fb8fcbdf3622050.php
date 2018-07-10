<?php $__env->startSection('content'); ?>
<!-- PRODUCT SECTION START -->
<section class="product-section pt-60" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row display-flex">
            <?php $__empty_1 = true; $__currentLoopData = $new_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            	<?php if($key == 1 && $single_post): ?>
            	<div class="col-md-4 col-sm-6 col-xs-6 col-xs-wide mb-30">
            		<div class="single-post">
	            		<h2 class="title"> Sản phẩm <span>mới</span> </h2>
	            		<p class="desc"><?php echo e($single_post->description); ?></p>
	            		<p class="image"><img src="<?php echo e(( $single_post->image && file_exists(public_path('/uploads/pages/'.$single_post->image)) ? asset( 'public/uploads/pages/'.get_thumbnail($single_post->image, '_small') ) : asset('noimage/370x230') )); ?>"></p>
            		</div>
            	</div>
            	<?php endif; ?>
            	<?php echo get_template_product($val,'san-pham',3,'mb-30'); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- PRODUCT SECTION END -->

<section class="collection-section pt-40" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="section-title"> <h2>Bộ <span>sưu tập</span> </h2> </div>
    </div>
    <div class="collection-wrap">
        <?php $__empty_1 = true; $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php echo get_template_collection($val,'bo-suu-tap',4); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php endif; ?>
    </div>
</section>

<section class="banner-section pt-60" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="section-title pb-40 text-center"> <h2>Banner</h2> </div>
        <div class="banner-wrap display-flex">
            <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="banner-item col-xs-6 col-xs-wide">
                <img src="<?php echo e(asset('public/uploads/photos/'.$banner->image)); ?>" alt="<?php echo e($banner->alt); ?>" />
                <h3 class="title"><?php echo e($banner->title); ?></h3>
                <span class="label <?php echo e(($key+1)%2 == 0 ? 'label-left' : 'label-right'); ?>"><?php echo e($banner->alt); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="blog-section pt-60" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="section-title"> <h2>Tin tức <span>mới</span> </h2> </div>
        <div class="row">
            <div class="slick-blog">
                <?php $__empty_1 = true; $__currentLoopData = $new_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div>
                    <?php echo get_template_post($val,'tin-tuc',1); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>