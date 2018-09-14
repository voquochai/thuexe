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
                    <a href="<?php echo e(route('admin.wms_export.create',['type'=>$type])); ?>" class="btn btn-sm btn-default"> Thêm mới </a>
                    
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
                                <th width="7%"> Nhân viên </th>
                                <th width="7%"> Mã phiếu </th>
                                
                                <th width="7%"> Tổng xuất </th>
                                <th width="7%"> Tổng tiền </th>
                                <th width="7%"> Ngày tạo </th>
								<th width="7%"> Tình trạng </th>
                                <th width="10%"> Thực thi </th>
							</tr>
						</thead>
						<tbody>
                            <tr>
                                <td colspan="30" align="center">
                                    Tổng số lượng: <span class="font-red-mint font-md bold"> <?php echo e(get_currency_vn($total->qty,'')); ?> </span>
                                    -
                                    Tổng tiền: <span class="font-red-mint font-md bold"> <?php echo e(get_currency_vn($total->price,'')); ?> </span>
                                </td>
                            </tr>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr id="record-<?php echo e($item->id); ?>">
                                <td align="center">
                                    <label class="mt-checkbox mt-checkbox-single">
                                        <input type="checkbox" name="id[]" class="checkable" value="<?php echo e($item->id); ?>">
                                        <span></span>
                                    </label>
                                </td>
                                <td align="center"> <input type="text" name="priority" class="form-control input-mini input-priority" value="<?php echo e($item->priority); ?>" data-ajax="act=update_priority|table=wms_exports|id=<?php echo e($item->id); ?>|col=priority"> </td>
                                <td align="center"><?php echo e($item->username); ?></td>
                                <td align="center"><?php echo e($item->code); ?></td>
                                
                                <td align="center"><?php echo e($item->export_qty); ?></td>
                                <td align="center"><?php echo e(get_currency_vn($item->export_price,'')); ?></td>
                                <td align="center"> <?php echo e($item->created_at); ?> </td>
                                <td align="center">
                                    <?php $__currentLoopData = $siteconfig[$type]['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyS => $valS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(strpos($item->status,$keyS) !== false): ?>
                                        <span class="label label-sm label-<?php echo e(($keyS == 'publish') ? 'primary' : 'danger'); ?>"> <?php echo e($valS); ?> </span>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td align="center">
                                    <a href="<?php echo e(route('admin.wms_export.edit',['id'=>$item->id, 'type'=>$type])); ?>" class="btn btn-sm blue" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
                                    <?php if($item->status == 'publish'): ?>
                                    <a href="#" data-target="#cancel-modal" data-toggle="modal" data-url="<?php echo e(route('admin.wms_export.delete',['id'=>$item->id, 'type'=>$type])); ?>" class="btn btn-sm btn-cancel red" title="Hủy phiếu"> <i class="fa fa-ban"></i> </a>
                                    <?php endif; ?>
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
<!-- Add Cancel Modal -->
<div id="cancel-modal" class="modal fade" tabindex="-1" data-focus-on="input:first">
    <form role="form" method="POST" action="#" class="form-validation">
        <?php echo e(csrf_field()); ?>

        <?php echo e(method_field('DELETE')); ?>

        <input type="hidden" name="data[status]" value="cancel">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title uppercase">Lý do hủy phiếu</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div>
                    <textarea name="data[note_cancel]" class="form-control validate[required]" rows="5" data-prompt-position="bottomRight:-100"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn default">Thoát</button>
            <button type="submit" class="btn green" > <i class="fa fa-check"></i> Lưu</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>