<?php $__env->startSection('content'); ?>
<div class="row">
    <?php if( $item !== null ): ?>
    <div class="col-xs-12">
        <div class="pb-20">
            <p class="text-right font-sm">Đơn hàng #<?php echo e($item->code); ?> được tạo ngày <?php echo e($item->created_at); ?> </p>
            <p class="text-right"><button class="btn btn-lg btn-<?php echo e(config('siteconfig.order_site_labels.'.$item->status_id)); ?>"> <?php echo e(config('siteconfig.order_site_status.'.$item->status_id)); ?> </button></p>
        </div>
        <div class="alert alert-info mb-40">
            <h4 class="text-center uppercase bold pt-10">Thông tin hợp đồng</h4>
        </div>
        <div>
            <p> <b> Kính gửi (Ông/Bà):</b> <?php echo e($item->name); ?></p>
            <p> Chúng tôi xin chân thành cảm ơn Quý khách đã tín nhiệm sử dụng dịch vụ của <?php echo e(config('app.name')); ?>. Dưới đây là thông tin các dịch vụ Quý khách đã đăng ký.</p>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="active">
                        <th width="15%"> Mã đơn hàng </th>
                        <th width="20%"> Ngày tạo </th>
                        <th width="20%"> Ngày thanh toán </th>
                        <th width="25%"> Hình thức thanh toán </th>
                        <th width="20%"> Tổng tiền </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="center"> <?php echo e($item->code); ?> </td>
                        <td align="center"> <?php echo e($item->created_at); ?> </td>
                        <td align="center"> </td>
                        <td align="center"> <?php echo e(config('siteconfig.payment_method.'.$item->payment_id)); ?> </td>
                        <td align="center"> <?php echo e(get_currency_vn($item->order_price)); ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pt-60 pb-20">
            <h4 class="uppercase font-red bold">Chi tiết đơn hàng</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="active">
                        <th width="5%"> Stt </th>
                        <th> <?php echo e(__('cart.product_name')); ?> </th>
                        <th width="20%"> <?php echo e(__('cart.quantity')); ?> </th>
                        <th width="20%"> <?php echo e(__('cart.total')); ?> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td align="center"> <?php echo e($key+1); ?> </td>
                        <td> <?php echo e($product->product_title); ?> </td>
                        <td align="center"> <?php echo e($product->product_qty); ?> </td>
                        <td align="center"> <?php echo e(get_currency_vn($product->product_price*$product->product_qty)); ?> </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                    <tr class="active">
                        <td align="right" colspan="3"> Tổng tiền </td>
                        <td align="center"> <b class="bold font-red font-lg"><?php echo e(get_currency_vn($item->order_price)); ?></b> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
    <div class="col-xs-12">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p> <?php echo e(__('site.no_data')); ?> </p>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.member.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>