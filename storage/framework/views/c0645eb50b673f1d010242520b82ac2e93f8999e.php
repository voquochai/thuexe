<?php $__env->startSection('content'); ?>
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-xs-12">
                <div class="post-detail">
                    <h1 class="title"><?php echo e($post->title); ?></h1>
                    <div class="meta">
                        <span><a href="<?php echo e(url('/'.$type.'/'.$category->slug)); ?>"><i class="fa fa-tags"></i> <?php echo e(@$category->title); ?> </a></span>
                        <span><a><i class="fa fa-user"></i> <?php echo e(@$author->name); ?></a></span>
                        <span><a><i class="fa fa-eye"></i> <?php echo e(__('site.view')); ?> (<?php echo e($post->viewed); ?>)</a></span>
                    </div>
                    <div class="desc">
                        <?php echo e($post->description); ?>

                    </div>
                    <div class="image">
                        <img alt="" src="<?php echo e(asset('public/uploads/posts/'.$post->image)); ?>">
                    </div>
                    <div class="content mb40"><?php echo $post->contents; ?></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?php echo $__env->make('frontend.default.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>