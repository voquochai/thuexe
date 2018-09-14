<?php  $photos = get_photos('partners',$lang);  ?>
<section class="partners-section">
    <div class="slick-partners">
    <?php $__empty_1 = true; $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div>
            <a href="<?php echo e($photo->link); ?>"><img src="<?php echo e(( $photo->image && file_exists(public_path('/uploads/photos/'.$photo->image)) ? asset( 'public/uploads/photos/'.get_thumbnail($photo->image) ) : asset('noimage/200x100') )); ?>" alt="<?php echo e($photo->alt); ?>" /></a></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php endif; ?>
    </div>
</section>