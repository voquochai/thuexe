<?php $__env->startSection('breadcrumb'); ?>
<li>
    <span> Nhóm quản trị </span>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<?php echo $__env->make('admin.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers"></i>Danh sách
                </div>
                <div class="actions">
                    <a href="<?php echo e(route('admin.group.create')); ?>" class="btn btn-sm btn-default"> Thêm mới </a>
                    <div class="btn-group">
                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Hành động (<span class="count-checkbox">0</span>)
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="publish" data-ajax="act=update_status|table=groups|col=status|val=publish"> Hiển thị </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="delete" data-ajax="act=delete_record|table=groups"> Xóa dữ liệu </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="portlet-body">
				<div class="table-responsive">
					<table class="table table-bordered table-condensed">
						<thead>
							<tr>
								<th width="1%">
                                    <label class="mt-checkbox mt-checkbox-single">
                                        <input type="checkbox" name="select" class="group-checkable">
                                        <span></span>
                                    </label>
                                </th>
								<th width="3%"> Thứ tự </th>
                                <th width="20%"> Tiêu đề </th>
                                <th width="10%"> Ngày tạo </th>
								<th width="10%"> Tình trạng </th>
                                <th width="10%"> Thực thi </th>
							</tr>
						</thead>
						<tbody>
							<?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr id="record-<?php echo e($item->id); ?>">
                                <td align="center">
                                    <label class="mt-checkbox mt-checkbox-single">
                                        <input type="checkbox" name="id[]" class="checkable" value="<?php echo e($item->id); ?>">
                                        <span></span>
                                    </label>
                                </td>
                                <td align="center"> <input type="text" name="priority" class="form-control input-mini input-priority" value="<?php echo e($item->priority); ?>" data-ajax="act=update_priority|table=groups|id=<?php echo e($item->id); ?>|col=priority"> </td>
                                <td align="center"><a href="<?php echo e(route('admin.group.edit',['id'=>$item->id])); ?>"> <?php echo e($item->display_name); ?> </a></td>
                                <td align="center"> <?php echo e($item->created_at); ?> </td>
                                <td align="center">
                                    <button class="btn btn-sm btn-status btn-status-publish btn-status-publish-<?php echo e($item->id.' '.( ($item->status == 'publish') ? 'blue' : 'default' )); ?>" data-loading-text="<i class='fa fa-spinner fa-pulse'></i>" data-ajax="act=update_status|table=groups|id=<?php echo e($item->id); ?>|col=status|val=publish"> Hiển thị </button>
                                </td>
                                <td align="center">
                                    <a href="<?php echo e(route('admin.group.edit',['id'=>$item->id])); ?>" class="btn btn-sm blue" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
                                    <form action="<?php echo e(route('admin.group.delete',['id'=>$item->id])); ?>" method="post">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                        <button type="button" class="btn btn-sm btn-delete red" title="Xóa"> <i class="fa fa-times"></i> </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="30" align="center"> Không có bản dữ liệu trong bảng </td>
                            </tr>
                            <?php endif; ?>
						</tbody>
					</table>
				</div>
				<div class="text-center"> <?php echo e($items->links()); ?> </div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>