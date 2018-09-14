<?php $__env->startSection('content'); ?>
<div class="row"> <?php echo $__env->make('frontend.default.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> </div>
<div class="panel panel-default panel-profile">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo e(__('account.profile')); ?></h3>
    </div>
    <div class="panel-body">
    	
    	<form role="form" method="POST" action="<?php echo e(route('frontend.member.profile')); ?>" >
    		<?php echo e(csrf_field()); ?>

        	<?php echo e(method_field('put')); ?>


        	<div class="form-group row">
                <label class="control-label col-md-3">Email</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo e($member->email); ?>" disabled>
                </div>
            </div>

        	<div class="form-group row">
                <label class="control-label col-md-3">Họ và tên</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="data[name]" class="form-control" value="<?php echo e($member->name); ?>">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="control-label col-md-3">Điện thoại</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="data[phone]" class="form-control" value="<?php echo e($member->phone); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3">Địa chỉ</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="data[address]" class="form-control" value="<?php echo e($member->address); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-md-3">Tỉnh / Thành phố</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <select class="form-control province" name="data[province_id]">
                        <option value="<?php echo e($member->province_id); ?>" selected ></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3">Quận / Huyện</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <select class="form-control district" name="data[district_id]">
                        <option value="<?php echo e($member->district_id); ?>" selected ></option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-md-3">Mật khẩu cũ</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="password" name="oldpassword" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3">Mật khẩu mới</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="password" name="password" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3">Xác nhận mật khẩu mới</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="password" name="password_confirmation" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9 col-sm-12 col-xs-12 pull-right">
                    <button type="submit" class="btn btn-site"> Cập nhật </button>
                </div>
            </div>

    	</form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.member.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>