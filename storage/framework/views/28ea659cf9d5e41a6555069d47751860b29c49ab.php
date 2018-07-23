<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="header-top-left">
                <ul>
                    <li> <a href="tel:<?php echo e(config('settings.site_hotline')); ?>"> <i class="pe-7s-phone"></i> <span class="hidden-xs"><?php echo e(config('settings.site_hotline')); ?></span> </a> </li>
                    <li> <a href="mailto:<?php echo e(config('settings.site_email')); ?>"> <i class="pe-7s-mail-open"></i> <span class="hidden-xs"><?php echo e(config('settings.site_email')); ?></span> </a> </li>
                </ul>
            </div>
            <div class="header-top-right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <?php if( auth()->guard('member')->check() ): ?>
                                <?php echo e(auth()->guard('member')->user()->name); ?>

                            <?php else: ?>
                            <?php echo e(__('account.account')); ?>

                            <?php endif; ?>
                        </a>
                        <ul>
                            <?php if( auth()->guard('member')->check() ): ?>
                            <li>
                                <a href="<?php echo e(route('frontend.member.profile')); ?>">
                                    <i class="icon-user"></i> Thông tin </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="icon-key"></i> Thoát </a>
                                <form id="logout-form" action="<?php echo e(route('frontend.logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                            <?php else: ?>
                            <li><a href="<?php echo e(url('/login')); ?>"> <?php echo e(__('account.login')); ?> </a></li>
                            <li><a href="<?php echo e(url('/register')); ?>">  <?php echo e(__('account.register')); ?> </a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <div class="header-logo">
                        <?php if(Route::currentRouteName() == 'frontend.home.index'): ?>
                        <h1><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e((config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ? asset('public/uploads/photos/'.config('settings.logo')) : asset('noimage/190x30'))); ?>" alt="main logo"><strong><?php echo e(config('settings.site_name')); ?></strong></a></h1>
                        <?php else: ?>
                        <h2><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e((config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ? asset('public/uploads/photos/'.config('settings.logo')) : asset('noimage/190x30'))); ?>" alt="main logo"><strong><?php echo e(config('settings.site_name')); ?></strong></a></h2>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6 float-right">
                    <div class="header-option-btns float-right">
                        <!-- Header-search -->
                        <div class="header-search float-left">
                            <button class="search-toggle" data-toggle="modal" data-target="#searchModal" ><i class="pe-7s-search"></i></button>
                        </div>
                        <div class="header-cart float-left">
                            <!-- Cart Toggle -->
                            <a class="cart-toggle" href="javascript:;">
                                <i class="pe-7s-cart"></i>
                                <span class="countCart"><?php echo e($countCart); ?></span>
                            </a>
                            <!-- Mini Cart Brief -->
                            <div class="mini-cart text-left">
                                <div class="cart-top">
                                    <p><?php echo __('cart.has_item',['attribute'=>$countCart]); ?></p>
                                </div>
                                <!-- Cart Products -->
                                <div class="cart-items clearfix">
                                    <ul></ul>
                                </div>
                                <!-- Cart Total -->
                                <div class="cart-total">
                                    <p><?php echo e(__('cart.total')); ?> <span class="float-right sumOrderPrice"><?php echo e($sumOrderPrice); ?></span></p>
                                </div>
                                <!-- Cart Button -->
                                <div class="cart-bottom clearfix">
                                    <a href="<?php echo e(route('frontend.cart.index')); ?>" class="btn btn-site float-left"><?php echo e(__('site.cart')); ?></a>
                                    <a href="<?php echo e(route('frontend.cart.checkout')); ?>" class="btn btn-site float-right"><?php echo e(__('site.checkout')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>