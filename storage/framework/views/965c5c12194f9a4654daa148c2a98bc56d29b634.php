<?php $__env->startSection('content'); ?>
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row display-flex">
                    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php echo get_template_post($post,$type,3,'mb-30'); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
                <div class="page-pagination text-center">
                	<?php echo e($posts->links('frontend.default.blocks.paginate')); ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>