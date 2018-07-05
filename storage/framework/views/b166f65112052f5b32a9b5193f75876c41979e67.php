<?php  $slideshow = get_photos('slideshow',$lang);  ?>
<!-- START SLIDER SECTION -->
<section class="slider-section">
	<div id="home-slider" class="slides">
		<?php $__empty_1 = true; $__currentLoopData = $slideshow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
		<img src="<?php echo e(asset('public/uploads/photos/'.$slide->image)); ?>" alt="<?php echo e($slide->alt); ?>" title="#slider-caption-<?php echo e($key); ?>"  />
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
		<?php endif; ?>
	</div>
	<?php $__empty_1 = true; $__currentLoopData = $slideshow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	<div id="slider-caption-<?php echo e($key); ?>" class="nivo-html-caption">
		<div class="container">
			<div class="row">
				<div class="hero-slider-content col-xs-12">
					<h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s"><?php echo e($slide->title); ?></h2>
					<p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s"><?php echo e($slide->description); ?></p>
					<?php if($slide->link): ?>
					<a href="<?php echo e($slide->link); ?>" class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s"> View </a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	<?php endif; ?>
	
</section>
<!-- END SLIDER SECTION -->