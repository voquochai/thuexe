<div class="comment-wrapper mt-40 mb-40">
    <?php if( $countComment > 0 ): ?>
    <h3><?php echo e(__('site.comment').' ('.$countComment.')'); ?></h3>
    <?php echo get_template_comment($comments); ?>

    <?php endif; ?>
    <h3><?php echo e(__('site.comment')); ?></h3>
    <div class="comment-form main-form">
        <form action="<?php echo e(URL::current()); ?>" method="post">
            <input type="hidden" name="parent" value="0">
            <?php if( @$product->id ): ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <?php elseif( @$post->id ): ?>
            <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
            <?php endif; ?>
            <div class="row">
	            <div class="col-sm-4 col-xs-12">
	                <label for="name"><?php echo e(__('site.name')); ?></label>
	                <input name="name" type="text">
	            </div>
	            <div class="col-sm-8 col-xs-12">
	                <label for="email">Email</label>
	                <input name="email" type="text">
	            </div>
	            <div class="col-xs-12">
					<label for="description"><?php echo e(__('site.content')); ?></label>
					<textarea name="description"></textarea>
				</div>
	            <div class="col-xs-12">
	                <button type="submit" class="btn btn-primary btn-ajax" data-ajax="act=comment|type=default"> <?php echo e(__('site.send_comment')); ?> </button>
				</div>
			</div>
		</form>
    </div>
</div>