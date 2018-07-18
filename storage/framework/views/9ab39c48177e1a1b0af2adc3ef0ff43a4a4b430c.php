<?php $__env->startSection('content'); ?>
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row mb-30">
            <div class="col-xs-12 mb-30">
                <div class="product-details">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 col-xs-wide mb-30">
                            <div class="image">
                                <div class="slick-product-image">
                                    <div>
                                        <img src="<?php echo e(( $product->image && file_exists(public_path('/uploads/products/'.$product->image)) ? asset( 'public/uploads/products/'.$product->image ) : asset('noimage/500x625') )); ?>" alt="<?php echo e($product->alt); ?>" />
                                    </div>
                                    <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div>
                                        <img src="<?php echo e(( $image->image && file_exists(public_path('/uploads/products/'.$image->image)) ? asset( 'public/uploads/products/'.$image->image ) : asset('noimage/500x625') )); ?>" alt="<?php echo e($image->alt); ?>" />
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </div>
                                <div class="slick-product-thumb">
                                    <div>
                                        <div class="pd-10">
                                            <a href="javascript:;"><img src="<?php echo e(( $product->image && file_exists(public_path('/uploads/products/'.$product->image)) ? asset('thumbnail/100x100x2/uploads/products/'.$product->image) : asset('noimage/100x100') )); ?>" alt="<?php echo e($product->alt); ?>" /></a>
                                        </div>
                                    </div>
                                    <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div>
                                        <div class="pd-10">
                                            <a href="javascript:;"><img src="<?php echo e(( $image->image && file_exists(public_path('/uploads/products/'.$image->image)) ? asset('thumbnail/100x100x2/uploads/products/'.$image->image) : asset('noimage/100x100') )); ?>" alt="<?php echo e($image->alt); ?>" /></a>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12 mb-30">
                            <div class="info">
                                <ul>
                                    <li><h1 class="title"><?php echo e($product->title); ?></h1></li>
                                    <li><label><?php echo e(__('site.product_price')); ?>:</label><span class="price"><?php echo get_template_product_price($product->regular_price,$product->sale_price); ?></span></li>

                                    <?php $__empty_1 = true; $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php if( $attribute['name'] !== null && $attribute['value'] !== null ): ?>
                                        <li><label><?php echo $attribute['name']; ?></label>: <?php echo $attribute['value']; ?> </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>

                                    <?php if($product->description): ?>
                                    <li><?php echo e($product->description); ?></li>
                                    <?php endif; ?>

                                    <li>
                                        <label><?php echo e(__('site.product_color')); ?>:</label>
                                        <div class="color-list">
                                            <?php $__empty_1 = true; $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <button <?php echo ($key == 0) ? 'class="active"' : ''; ?> style="background-color: <?php echo e($color->value); ?>;" data-id="<?php echo e($color->id); ?>" ><i class="fa fa-check"></i></button>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label><?php echo e(__('site.product_size')); ?>:</label>
                                        <div class="size-list">
                                            <?php $__empty_1 = true; $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <button <?php echo ($key == 0) ? 'class="active"' : ''; ?> data-id="<?php echo e($size->id); ?>" ><i class="fa fa-check"></i> <?php echo e($size->title); ?> </button>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
                                        </div>
                                    </li>

                                    <li>
                                        <label><?php echo e(__('cart.quantity')); ?>:</label>
                                        <div class="quantity">
                                            <input type="text" name="quantity" value="1">
                                        </div>
                                        <a href="#" id="add-to-cart" class="btn btn-site uppercase" data-ajax="id=<?php echo e($product->id); ?>"> Thêm giỏ hàng </a>
                                    </li>

                                    <li>
                                        <label>Share:</label>
                                        <div class="share-icons">
                                            <a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->current()); ?>"><i class="fa fa-facebook"></i>  facebook</a>
                                            <a target="_blank" class="twitter" href="https://twitter.com/home?status=<?php echo e(url()->current()); ?>"><i class="fa fa-twitter"></i>  twitter</a>
                                            <a target="_blank" class="google" href="https://plus.google.com/share?url=<?php echo e(url()->current()); ?>"><i class="fa fa-google-plus"></i>  google</a>
                                            <a target="_blank" class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo e(url()->current()); ?>&media=<?php echo e(asset('public/uploads/products/'.$product->image)); ?>&description=<?php echo e($product->description); ?>"><i class="fa fa-pinterest"></i>  pinterest</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <?php echo $product->contents; ?>

                    </div>
                </div>
                <!-- Comments Wrapper -->
                <?php echo $__env->make('frontend.default.blocks.comment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 mb-40">
                <div class="sidebar" id="app-cart">
                    <div class="sidebar-widget mb-40">
                        <div class="product-attributes">
                            <ul>
                            
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget mb-40">
                        <div class="product-price">
                            <div class="float-left"><label></label></div>
                            <div class="float-right"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
    
<!-- PRODUCT SECTION START -->
<section class="page-section pb-60">
    <div class="container">
        <div class="row">
            <div class="section-title text-center col-xs-12 mb-70">
                <h2><?php echo e(__('site.product_other')); ?></h2>
            </div>
        </div>
        <div class="row display-flex">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php echo get_template_product($item,$type,3); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- PRODUCT SECTION END --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>