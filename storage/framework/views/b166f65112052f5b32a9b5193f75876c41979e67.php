<?php  $slideshow = get_photos('slideshow',$lang);  ?>
<!-- START SLIDER SECTION -->
<section class="slider-section section">
	<div id="home-slider" class="slides">
		<?php $__empty_1 = true; $__currentLoopData = $slideshow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
		<img src="<?php echo e(asset('public/uploads/photos/'.$slide->image)); ?>" alt="" title="#slider-caption-0"  />
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
		<?php endif; ?>
	</div>
	
</section>
<!-- END SLIDER SECTION -->