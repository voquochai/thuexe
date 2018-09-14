<?php $__env->startSection('content'); ?>
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <?php echo $__env->make('frontend.default.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="checkout-form">
                <form method="post" action="<?php echo e(url('/thanh-toan')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="col-lg-7 col-md-6 col-xs-12 mb-30">
                        <h3> <?php echo e(__('cart.billing_details')); ?> </h3>
                        <div class="row">
                            <div class="col-xs-12 mb-15">
                                <label for="name"><?php echo e(__('cart.name')); ?> <span class="required">*</span></label>                                        
                                <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>"/>
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label for="address"><?php echo e(__('cart.address')); ?> <span class="required">*</span></label>
                                <input type="text" name="address" class="form-control" value="<?php echo e(old('address')); ?>" />
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label for="email">Email<span class="required">*</span></label>                                      
                                <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" />
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label for="phone"><?php echo e(__('cart.phone')); ?>  <span class="required">*</span></label>                                     
                                <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>" />
                            </div>
                            <div class="col-sm-6 col-xs-12 mb-15">
                                <label for="province"><?php echo e(__('cart.province')); ?> <span class="required">*</span></label>
                                <select class="province form-control" name="province_id">
                                    <option value="<?php echo e(old('province_id')); ?>" selected ></option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-12 mb-15">
                                <label for="district"><?php echo e(__('cart.district')); ?> <span class="required">*</span></label>
                                <select class="district form-control" name="district_id">
                                    <option value="<?php echo e(old('district_id')); ?>" selected ></option>
                                </select>
                            </div>
                        </div>
                        <div class="order-notes">
                            <label for="order_note"><?php echo e(__('cart.notes')); ?></label>
                            <textarea name="order_note" class="form-control"><?php echo e(old('order_note')); ?></textarea>                           
                        </div>
                                                             
                    </div>
                    <div class="col-lg-5 col-md-6 col-xs-12 mb-30">
                        <div class="coupon-form mb-30">
                            <div class="cart-coupon">
                                <h3> Coupon </h3>
                                <p> <?php echo e(__('cart.enter_coupon')); ?> </p>
                                <input type="text" class="form-control" placeholder="<?php echo e(__('cart.coupon_code')); ?>" value="<?php echo e(@$coupon['code']); ?>" />
                                <button type="button" class="btn btn-site"><?php echo e(__('cart.use')); ?></button>
                            </div>
                            <div id="result-coupon">
                                <?php if( $coupon ): ?>
                                <div class="alert alert-<?php echo e($coupon['effective']['type']); ?> no-margin">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <i class="fa-lg fa fa-<?php echo e($coupon['effective']['icon']); ?>"></i> <?php echo $coupon['effective']['message']; ?>

                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="order-wrapper">
                            <h3> <?php echo e(__('cart.your_order')); ?> </h3>
                            <div class="order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name"><?php echo e(__('cart.product_name')); ?></th>
                                            <th class="product-total"><?php echo e(__('cart.total')); ?> (Đ)</th>
                                        </tr>                           
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr class="pro-key-<?php echo e($key); ?>">
                                                <td class="product-name">
                                                    <?php echo e($val['title'].($val['color_title'] ? ' - '.$val['color_title'] : '').($val['size_title'] ? ' - '.$val['size_title'] : '')); ?> <strong class="product-qty"> × <?php echo e($val['qty']); ?> </strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount"><?php echo e(get_currency_vn($val['price']*$val['qty'],'')); ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr> <td colspan="10"> <?php echo e(__('cart.no_item')); ?> </td> </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><?php echo e(__('cart.cart_total')); ?></th>
                                            <td><span class="sumCartPrice"></span></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('cart.order_total')); ?></th>
                                            <td><strong class="sumOrderPrice"></strong>
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
                            <center> <button type="submit" class="btn btn-site"><?php echo e(__('cart.place_order')); ?></button> </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>