<div class="sidebar">
    <div class="sidebar-widget mb-20">
        <h4 class="title"><?php echo e(auth()->guard('member')->user()->name); ?></h4>
        <ul class="category">
            <li> <a href="<?php echo e(route('frontend.member.profile')); ?>" <?php echo (Route::currentRouteName() == 'frontend.member.profile') ? 'class="active"' : ''; ?> > <?php echo e(__('account.profile')); ?> </a> </li>
            <li> <a href=""> <?php echo e(__('account.notification')); ?> </a> </li>
            <li> <a href="<?php echo e(route('frontend.member.order')); ?>" <?php echo (Route::currentRouteName() == 'frontend.member.order') ? 'class="active"' : ''; ?> > <?php echo e(__('account.order_management')); ?> </a> </li>
            <li> <a href=""> <?php echo e(__('account.delivery_address')); ?> </a> </li>
            <li> <a href="<?php echo e(route('frontend.home.viewed')); ?>"> <?php echo e(__('account.viewed')); ?> </a> </li>
            <li> <a href="<?php echo e(route('frontend.wishlist.index')); ?>"> <?php echo e(__('account.wishlist')); ?> </a> </li>
        </ul>
    </div>
</div>