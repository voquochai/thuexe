<?php  $links = get_links('tieu-chi',$lang);  ?>
<div class="service-section ptb-60">
    <div class="container">
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="single-service col-md-3 col-sm-6 col-xs-6 mb-30">
                <div class="service-icon">
                    <?php echo $link->icon; ?>

                </div>
                <div class="service-title">
                    <h3> <?php echo e($link->title); ?> </h3>
                    <p> <?php echo e($link->description); ?> </p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </div>
    </div>
</div>