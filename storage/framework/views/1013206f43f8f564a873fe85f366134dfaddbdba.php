<?php $__env->startSection('breadcrumb'); ?>
<li>
    <a href="<?php echo e(route('admin.coupon.index')); ?>"> Coupon </a>
    <i class="fa fa-circle"></i>
</li>
<li>
    <span>Chỉnh sửa</span>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('admin.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- BEGIN FORM-->
    <form role="form" method="POST" action="<?php echo e(route('admin.coupon.update',['id'=>$item->id])); ?>" enctype="multipart/form-data" >
        <?php echo e(csrf_field()); ?>

        <?php echo e(method_field('put')); ?>

        <input type="hidden" name="data[change_conditions_type]" value="<?php echo e($item->change_conditions_type); ?>">
        <input type="hidden" name="redirects_to" value="<?php echo e((old('redirects_to')) ? old('redirects_to') : url()->previous()); ?>" />
        <div class="col-lg-9 col-xs-12"> 
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"> Chỉnh sửa </div>
                </div>
                <div class="portlet-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Tên</label>
                        <div>
                            <input type="text" class="form-control" name="data[title]" value="<?php echo e($item->title); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Mô tả</label>
                        <div>
                            <textarea name="data[description]" class="form-control" rows="6"><?php echo e($item->description); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">Thông tin chung </div>
                </div>
                <div class="portlet-body">
                    <div class="form-group">
                        <label class="control-label">Mã coupon</label>
                        <div>
                            <input type="text" name="code" class="form-control" readonly="" value="<?php echo e($item->code); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Số tiền coupon</label>
                        <div class="input-group">
                            <input type="text" name="coupon_amount" class="form-control priceFormat" value="<?php echo e($item->coupon_amount); ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-info" id="change-conditions-type" value="<?php echo e($item->change_conditions_type); ?>"> <?php echo e(($item->change_conditions_type == 'percentage_discount_from_total_cart') ? '%': 'VNĐ'); ?>  </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Số lần sử dụng</label>
                        <div>
                            <input type="text" name="number_of_uses" class="form-control priceFormat" value="<?php echo e($item->number_of_uses); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Điều kiện</label>
                        <i class="help-block"> Áp dụng cho đơn hàng có tổng tiền từ </i>
                        <div class="input-group input-daterange">
                            <input type="text" name="min_restriction_amount" class="form-control priceFormat" value="<?php echo e($item->min_restriction_amount); ?>">
                            <span class="input-group-addon">tới</span>
                            <input type="text" name="max_restriction_amount" class="form-control priceFormat" value="<?php echo e($item->max_restriction_amount); ?>">
                            
                        </div>
                        <i class="help-block"> Áp dụng từ ngày </i>
                        <div class="input-group input-daterange startDate" data-provide="datepicker" data-date-format="yyyy/mm/dd">
                            <input type="text" class="form-control" readonly="" name="data[begin_at]" value="<?php echo e($item->begin_at); ?>">
                            <span class="input-group-addon">tới</span>
                            <input type="text" class="form-control" readonly="" name="data[end_at]" value="<?php echo e($item->end_at); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Tình trạng</label>
                        <div>
                            <select class="selectpicker show-tick show-menu-arrow form-control" name="status[]" multiple>
                                <option value="publish" <?php echo e($item->status == 'publish' ? 'selected' : ''); ?> > Hiển thị </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Thứ tự</label>
                        <div>
                            <input type="text" name="priority" value="<?php echo e($item->priority); ?>" class="form-control priceFormat">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn green"> <i class="fa fa-check"></i> Lưu</button>
                        <a href="<?php echo e(url()->previous()); ?>" class="btn default" > Thoát </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>