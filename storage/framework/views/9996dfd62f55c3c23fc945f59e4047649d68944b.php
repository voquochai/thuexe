<nav class="main-menu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
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
                    <li <?php echo ($type == 'dich-vu') ? 'class="active"' : ''; ?> ><a href="<?php echo e(url('/dich-vu')); ?>"> <?php echo e(__('site.service')); ?> </a>
                        <?php 
                            Menu::resetMenu();
                            Menu::setOption([
                                'open'=>['<ul class="sub-menu">'],
                                'baseurl' => url('/dich-vu')
                            ]);
                            Menu::setMenu(get_categories('dich-vu',$lang));
                            echo Menu::getMenu();
                         ?>
                    </li>
                    <li <?php echo ($type == 'tin-tuc') ? 'class="active"' : ''; ?> ><a href="<?php echo e(url('/tin-tuc')); ?>"> <?php echo e(__('site.news')); ?> </a>
                        <?php 
                            Menu::resetMenu();
                            Menu::setOption([
                                'open'=>['<ul class="sub-menu">'],
                                'baseurl' => url('/tin-tuc')
                            ]);
                            Menu::setMenu(get_categories('thu-thuat',$lang));
                            echo Menu::getMenu();
                         ?>
                    </li>
                    <li <?php echo (Route::currentRouteName() == 'frontend.home.contact') ? 'class="active"' : ''; ?> ><a href="<?php echo e(url('/lien-he')); ?>"> <?php echo e(__('site.contact')); ?> </a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="mobile-menu"></div>