<?php $__env->startSection('content'); ?>
<!-- PAGE SECTION START -->
<div class="page-section pt-100 pb-60">
    <div class="container">
        <div class="row">
            <?php echo $__env->make('frontend.default.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="checkout-form">
                <form method="post" action="<?php echo e(url('/thanh-toan')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="col-lg-6 col-md-6 mb-40">
                        <h3> <?php echo e(__('cart.billing_details')); ?> </h3>
                        <div class="row">
                            <div class="col-xs-12 mb-30">
                                <label for="b_f_name"><?php echo e(__('cart.name')); ?> <span class="required">*</span></label>                                        
                                <input id="b_f_name" name="name" type="text" value="<?php echo e(old('name')); ?>"/>
                            </div>
                            <div class="col-xs-12 mb-30">
                                <label><?php echo e(__('cart.address')); ?> <span class="required">*</span></label>
                                <input type="text" name="address" value="<?php echo e(old('address')); ?>" />
                            </div>
                            <div class="col-xs-12 mb-30">
                                <label for="b_email">Email<span class="required">*</span></label>                                      
                                <input id="b_email" type="email" name="email" value="<?php echo e(old('email')); ?>" />
                            </div>
                            <div class="col-xs-12 mb-30">
                                <label for="b_phone"><?php echo e(__('cart.phone')); ?>  <span class="required">*</span></label>                                     
                                <input id="b_phone" name="phone" type="text" value="<?php echo e(old('phone')); ?>" />
                            </div>
                            <div class="col-sm-6 col-xs-12 mb-30">
                                <label for="b_city"><?php echo e(__('cart.province')); ?> <span class="required">*</span></label>
                                <select id="b_province" class="province" name="province_id">
                                    <option value="<?php echo e(old('province_id')); ?>" selected ></option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-12 mb-30">
                                <label><?php echo e(__('cart.district')); ?> <span class="required">*</span></label>                                       
                                <select id="b_district" class="district" name="district_id">
                                    <option value="<?php echo e(old('district_id')); ?>" selected ></option>
                                </select>
                            </div>
                        </div>
                        <div class="order-notes">
                            <label for="order_note"><?php echo e(__('cart.notes')); ?></label>
                            <textarea id="order_note" name="order_note" ><?php echo e(old('order_note')); ?></textarea>                           
                        </div>
                                                             
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 mb-40">
                        <div class="coupon-form mb-30">
                            <div class="cart-coupon">
                                <h3> Coupon </h3>
                                <p> <?php echo e(__('cart.enter_coupon')); ?> </p>
                                <input type="text" placeholder="<?php echo e(__('cart.coupon_code')); ?>" value="<?php echo e(@$coupon['code']); ?>" />
                                <button type="button" ><?php echo e(__('cart.use')); ?></button>
                            </div>
                            <div id="result-coupon">
                                <?php if( $coupon ): ?>
                                <div class="custom-alerts alert alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <i class="fa-lg fa fa-check"></i> <?php echo e(__('cart.sale',['attribute'=>$coupon['coupon_amount_text']])); ?>

                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="order-wrapper">
                            <h3> <?php echo e(__('cart.your_order')); ?> </h3>
                            <div class="order-table table-responsive mb-30">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name"><?php echo e(__('cart.product_name')); ?></th>
                                            <th class="product-total"><?php echo e(__('cart.total')); ?> (Đ)</th>
                                        </tr>                           
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td class="product-name">
                                                    <?php echo e($val['title'].($val['color_title'] ? ' - '.$val['color_title'] : '').($val['size_title'] ? ' - '.$val['size_title'] : '')); ?> <strong class="product-qty"> × <?php echo e($val['qty']); ?> </strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount"><?php echo e($val['sumProPrice']); ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr> <td colspan="10"> <?php echo e(__('cart.no_item')); ?> </td> </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><?php echo e(__('cart.cart_total')); ?></th>
                                            <td><span class="sumCartPrice"><?php echo e($sumCartPrice); ?></span></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('cart.order_total')); ?></th>
                                            <td><strong class="sumOrderPrice"><?php echo e($sumOrderPrice); ?></strong>
                                            </td>
                                        </tr>                               
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="panel-group" id="accordion">
                                    <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label data-toggle="collapse" data-parent="#accordion" data-target="#collapse-<?php echo e($key); ?>"><input type="radio" name="payment" value="<?php echo e($payment->title); ?>" <?php echo e($key==0 ? 'checked' : ''); ?> > <?php echo e($payment->title); ?></label>
                                            </h4>
                                        </div>
                                        <div id="collapse-<?php echo e($key); ?>" class="panel-collapse collapse <?php echo e($key==0 ? 'in' : ''); ?>">
                                            <div class="panel-body">
                                                <p> <?php echo e($payment->description); ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="order-button">
                            <center> <input type="submit" value="<?php echo e(__('cart.place_order')); ?>"> </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- PAGE SECTION END --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>