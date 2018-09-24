
<?php $__env->startSection('content'); ?>
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <!-- Single Detail -->
                <?php if($page): ?>
                <div class="post-detail">
                    <h1 class="title"><?php echo e($page->title); ?></h1>
                    <?php echo $page->contents; ?>

                </div>
                <?php else: ?>
                <?php echo __('site.update_content'); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>