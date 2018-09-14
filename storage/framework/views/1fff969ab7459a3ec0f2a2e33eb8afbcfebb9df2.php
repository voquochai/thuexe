<?php $__env->startSection('breadcrumb'); ?>
<li>
    <span> <?php echo e($pageTitle); ?> </span>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<?php echo $__env->make('admin.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet">
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> Bình luận </div>
                </div>
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-circle green btn-sm btn-comment-approved">Tất cả</button>
                    <button type="button" class="btn btn-circle default btn-sm btn-comment-unapproved">Chưa duyệt</button>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav nav-list-item-comment">
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li>
                            <a href="#comment-<?php echo e($item->product_id); ?>" data-ajax="table=products|id=<?php echo e($item->product_id); ?>"><?php echo e($item->title); ?> <span class="badge badge-success"><?php echo e($item->sum); ?></span></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-green"></i>
                        <span class="caption-subject bold font-green uppercase"> Bình luận</span>
                    </div>
                    <div class="actions">
                        <a href="#" id="btn-comment-delete-all" class="btn btn-sm btn-circle red"> <i class="icon-trash"></i> Xóa tất cả </a>
                    </div>
                </div>
                <div class="portlet-body" id="portlet-load-ajax">Không có dữ liệu trong bảng</div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>