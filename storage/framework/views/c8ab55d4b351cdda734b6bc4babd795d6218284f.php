<?php $__env->startComponent('mail::message'); ?>

<?php $__env->startComponent('mail::panel'); ?>
Cám ơn bạn đã đặt hàng tại website chúng tôi
<?php echo $__env->renderComponent(); ?>

<hr>
<p> Đơn hàng #<?php echo e($order->code); ?> của bạn bao gồm các sản phẩm sau đây:</p>

<?php $__env->startComponent('mail::table'); ?>

| MÃ SP | TÊN SẢN PHẨM | GIÁ BÁN (Đ) | SỐ LƯỢNG | TỔNG (Đ) |
|:-----:|--------------|:-------------:|:--------:|:----------:|
<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
| <?php echo e($product['product_code']); ?> | <?php echo e($product['product_title']); ?> | <?php echo e(number_format($product['product_price'],0,',','.')); ?> | <?php echo e($product['product_qty']); ?> | <?php echo e(number_format($product['product_price']*$product['product_qty'],0,',','.')); ?> |
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<?php endif; ?>
<td colspan=3 align="right"> Tổng tiền | <center><b><?php echo e(number_format($order->subtotal, 0, ',', '.')); ?> đ</b></center> |
<?php echo $__env->renderComponent(); ?>

<?php if($order->coupon_code !== null): ?>
<?php $__env->startComponent('mail::subcopy'); ?>
<p><i>Bạn được giảm <b><?php echo e(number_format($order->coupon_amount, 0, ',', '.')); ?> đ</b> cho đơn hàng này </i></p>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

<?php $__env->startComponent('mail::panel'); ?>
<p style="text-align: center;">Tổng đơn hàng: <b><?php echo e(number_format($order->total, 0, ',', '.')); ?> đ</b></p>
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::button', ['url' => route('frontend.cart.tracking',['email'=>$order->email, 'code'=>$order->code]), 'color' => 'green']); ?>
Xem đơn hàng
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>


<?php echo $__env->renderComponent(); ?>