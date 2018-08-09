<?php 
    $socials = get_links('social',$lang);
    $banks = get_photos('bank',$lang);
    $chinhsach = get_posts('chinh-sach-quy-dinh',$lang);
    $hotro = get_posts('ho-tro-khach-hang',$lang);
    $footer = get_pages('footer',$lang);
 ?>
<!-- FOOTER SECTION START -->
<footer class="footer-section">
    <div class="footer-top pt-40">
        <div class="container">
            <div class="row">
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-12 col-xs-12 mb-40">
                    <div class="logo mb-20">
                        <a href="index.html"><img src="<?php echo e((config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ? asset('public/uploads/photos/'.config('settings.logo')) : asset('noimage/170x55'))); ?>" alt="logo"></a>
                    </div>
                    <?php echo @$footer->contents; ?>

                    <div class="footer-social fix">
                        <?php $__empty_1 = true; $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e($link->link); ?>"> <?php echo $link->icon; ?> </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-6 col-xs-6 col-xs-wide mb-40">
                    <h4 class="widget-title">Chính sách &amp; Quy định</h4>
                    <ul>
                        <?php $__empty_1 = true; $__currentLoopData = $chinhsach; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li><a href="<?php echo e(route('frontend.home.page',['type'=>$val->type, 'slug'=>$val->slug])); ?>"><?php echo e($val->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-6 col-xs-6 col-xs-wide mb-40">
                    <h4 class="widget-title">Hỗ trợ khách hàng</h4>
                    <ul>
                        <?php $__empty_1 = true; $__currentLoopData = $hotro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li><a href="<?php echo e(route('frontend.home.page',['type'=>$val->type, 'slug'=>$val->slug])); ?>"><?php echo e($val->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-12 col-xs-12 mb-40">
                    <h4 class="widget-title"><?php echo e(__('site.newsletter')); ?></h4>
                    <?php echo $__env->make('frontend.default.layouts.newsletter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- Footer Social -->
                    
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER TOP SECTION END -->  

    <!-- FOOTER BOTTOM SECTION START -->
    <div class="footer-bottom ptb-20">
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="copyright text-center col-xs-12">
                    <p><?php echo e(config('settings.site_copyright')); ?></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER BOTTOM SECTION END -->