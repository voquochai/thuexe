<?php $__env->startSection('content'); ?>
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <!-- Single Blog Post -->
                <div class="single-blog-post">
                    <div class="blog-info">
                        <h3 class="title"><?php echo e($page->title); ?></h3>
                        <?php echo $page->contents; ?>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>