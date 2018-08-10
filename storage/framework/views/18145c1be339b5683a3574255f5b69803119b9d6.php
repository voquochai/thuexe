<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('frontend.default.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col-xs-12">
        <div class="cart-table table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="10%"> Ngày đặt </th>
                        <th width="7%"> Mã đơn hàng </th>
                        <th width="7%"> Số lượng </th>
                        <th width="7%"> Tổng giá </th>
                        <th width="10%"> Tình trạng </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr id="record-<?php echo e($item->id); ?>">
                        <td align="center"> <?php echo e($item->created_at); ?> </td>
                        <td align="center"><a href="<?php echo e(route('frontend.member.order_detail',['id'=>$item->id])); ?>"><?php echo e($item->code); ?></a></td>
                        <td align="center"><?php echo e($item->quantity); ?></td>
                        <td align="center"><?php echo e(get_currency_vn($item->total,'')); ?></td>
                        <td align="center"><?php echo e(config('siteconfig.order_site_status.'.$item->status_id)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="30" align="center"> Không có bản dữ liệu trong bảng </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center"> <?php echo e($items->links('frontend.default.blocks.paginate')); ?> </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.member.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>