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
                    <a href="<?php echo e(route('admin.category.create',['type'=>$type])); ?>" class="btn btn-sm btn-default"> Thêm mới </a>
                    <div class="btn-group">
                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Hành động (<span class="count-checkbox">0</span>)
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <?php $__currentLoopData = $siteconfig[$type]['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="<?php echo e($key); ?>" data-ajax="act=update_status|table=categories|col=status|val=<?php echo e($key); ?>"> <?php echo e($act); ?> </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="delete" data-ajax="act=delete_record|table=categories|config=category|type=<?php echo e($type); ?>"> Xóa dữ liệu </a>
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
								<?php if($siteconfig[$type]['image']): ?>
                                <th width="15%"> Hình ảnh </th>
                                <?php endif; ?>
                                <th width="10%"> Ngày tạo </th>
                                <th width="10%"> Tình trạng </th>
                                <th width="10%"> Thực thi </th>
							</tr>
						</thead>
						<tbody>
							<?php 
                                Menu::setMenu($items);
                                $menu = Menu::getMenuTable();
                                if($menu){
                                    echo $menu;
                                }else{
                                    echo '<tr>
                                            <td colspan="30" align="center"> Không có bản dữ liệu trong bảng </td>
                                        </tr>';
                                }
                             ?>
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