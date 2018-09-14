<?php $__env->startSection('breadcrumb'); ?>
<li>
    <span> <?php echo e($pageTitle); ?> </span>
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
                    <a href="<?php echo e(route('admin.photo.create',['type'=>$type])); ?>" class="btn btn-sm btn-default"> Thêm mới </a>
                    <div class="btn-group">
                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Hành động (<span class="count-checkbox">0</span>)
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <?php $__currentLoopData = $siteconfig[$type]['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="<?php echo e($key); ?>" data-ajax="act=update_status|table=photos|col=status|val=<?php echo e($key); ?>"> <?php echo e($act); ?> </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="delete" data-ajax="act=delete_record|table=photos|config=photo|type=<?php echo e($type); ?>"> Xóa dữ liệu </a>
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
                                <th width="15%"> Tiêu đề </th>
								<?php if($siteconfig[$type]['image']): ?>
                                <th width="15%"> Hình ảnh </th>
                                <?php endif; ?>
                                <?php if($siteconfig[$type]['link']): ?>
                                <th width="15%"> Link </th>
                                <?php endif; ?>
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
                                <td align="center"> <input type="text" name="priority" class="form-control input-mini input-priority" value="<?php echo e($item->priority); ?>" data-ajax="act=update_priority|table=photos|id=<?php echo e($item->id); ?>|col=priority"> </td>
                                <td align="center"><a href="<?php echo e(route('admin.photo.edit',['id'=>$item->id, 'type'=>$type])); ?>"> <?php echo e($item->title); ?> </a></td>
                                <?php if($siteconfig[$type]['image']): ?>
                                <td align="center"><?php echo ( ($item->image && file_exists(public_path(get_thumbnail($path.'/'.$item->image))) ) ? '<img src="'.asset( get_thumbnail('public/'.$path.'/'.$item->image) ).'" height="50" />' : ''); ?></td>
                                <?php endif; ?>

                                <?php if($siteconfig[$type]['link']): ?>
                                <td align="center"><?php echo e($item->link); ?></td>
                                <?php endif; ?>
                                <td align="center"> <?php echo e($item->created_at); ?> </td>
                                <td align="center">
                                    <?php $__currentLoopData = $siteconfig[$type]['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyS => $valS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button class="btn btn-sm btn-status btn-status-<?php echo e($keyS); ?> btn-status-<?php echo e($keyS.'-'.$item->id.' '.((strpos($item->status,$keyS) !== false)?'blue':'default')); ?>" data-loading-text="<i class='fa fa-spinner fa-pulse'></i>" data-ajax="act=update_status|table=photos|id=<?php echo e($item->id); ?>|col=status|val=<?php echo e($keyS); ?>"> <?php echo e($valS); ?> </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td align="center">
                                    <a href="<?php echo e(route('admin.photo.edit',['id'=>$item->id, 'type'=>$type])); ?>" class="btn btn-sm blue" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
                                    <form action="<?php echo e(route('admin.photo.delete',['id'=>$item->id, 'type'=>$type])); ?>" method="post">
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
				<div class="text-center"> <?php echo e($items->appends(['type'=>$type])->links()); ?> </div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>