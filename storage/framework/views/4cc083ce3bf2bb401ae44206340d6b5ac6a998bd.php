<?php 
    $socials = get_links('social',$lang);
 ?>
<nav class="navbar-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="float-left">
                    <ul class="navbar-nav">
                        <li <?php echo (Route::currentRouteName() == 'frontend.home.index') ? 'class="active"' : ''; ?> ><a href="<?php echo e(url('/')); ?>"> <?php echo e(__('site.home')); ?> </a></li>
                        <li <?php echo ($type == 'gioi-thieu') ? 'class="active"' : ''; ?> ><a href="<?php echo e(url('/gioi-thieu')); ?>"> <?php echo e(__('site.about')); ?> </a></li>
                        <li class="menu_style_column mega-col-columns-4 <?php echo ($type == 'san-pham') ? 'active' : ''; ?>" ><a href="<?php echo e(url('/san-pham')); ?>"> <?php echo e(__('site.product')); ?> </a>
                            <?php 
                                Menu::resetMenu();
                                Menu::setOption([
                                    'open'=>['<ul class="sub-menu animated fadeIn">'],
                                    'openitem'=>'<li class="menu_style_dropdown">',
                                    'baseurl' => url('/san-pham')
                                ]);
                                Menu::setMenu(get_categories('san-pham',$lang));
                                echo Menu::getMenu();
                             ?>
                        </li>
                        <li class="menu_style_dropdown <?php echo ($type == 'tin-tuc') ? 'active' : ''; ?>" ><a href="<?php echo e(url('/tin-tuc')); ?>"> <?php echo e(__('site.news')); ?> </a>
                            <?php 
                                Menu::resetMenu();
                                Menu::setOption([
                                    'open'=>['<ul class="sub-menu animated fadeIn">'],
                                    'baseurl' => url('/tin-tuc')
                                ]);
                                Menu::setMenu(get_categories('tin-tuc',$lang));
                                echo Menu::getMenu();
                             ?>
                        </li>
                        <li class="menu_style_dropdown <?php echo ($type == 'dich-vu') ? 'active' : ''; ?>" ><a href="<?php echo e(url('/dich-vu')); ?>"> <?php echo e(__('site.service')); ?> </a>
                            <?php 
                                Menu::resetMenu();
                                Menu::setOption([
                                    'open'=>['<ul class="sub-menu animated fadeIn">'],
                                    'baseurl' => url('/dich-vu')
                                ]);
                                Menu::setMenu(get_categories('dich-vu',$lang));
                                echo Menu::getMenu();
                             ?>
                        </li>
                        <li <?php echo (Route::currentRouteName() == 'frontend.home.contact') ? 'class="active"' : ''; ?> ><a href="<?php echo e(url('/lien-he')); ?>"> <?php echo e(__('site.contact')); ?> </a></li>
                    </ul>
                </div>
                <div class="float-right">
                    <ul class="navbar-social">
                        <?php $__empty_1 = true; $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li><a href="<?php echo e($link->link); ?>"> <?php echo $link->icon; ?> </a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="mobile-menu"></div>