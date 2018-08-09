<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<div class="modal-body">
    <div class="login-wrap">
        <div class="row">
            <div class="col-md-4 logo">
                <div>
                    <h4 class="form-title"><?php echo e(__('account.create_account')); ?></h4></div>
            </div>
            <div class="col-md-8">
                <div class="content">
                    <form class="register-form" role="form" method="POST" action="<?php echo e(route('frontend.register')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="row"><?php echo $__env->make('admin.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"><?php echo e(__('account.name')); ?></label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control placeholder-no-fix" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('account.name')); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="text" name="email" class="form-control placeholder-no-fix" value="<?php echo e(old('email')); ?>" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"><?php echo e(__('account.phone')); ?></label>
                            <div class="col-md-9">
                                <input type="text" name="phone" class="form-control placeholder-no-fix" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('account.phone')); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"><?php echo e(__('account.address')); ?></label>
                            <div class="col-md-9">
                                <input type="text" name="address" class="form-control placeholder-no-fix" value="<?php echo e(old('address')); ?>" placeholder="<?php echo e(__('account.address')); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3"><?php echo e(__('account.username')); ?></label>
                            <div class="col-md-9">
                                <input type="text" name="username" class="form-control placeholder-no-fix" value="<?php echo e(old('username')); ?>" placeholder="<?php echo e(__('account.username')); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"><?php echo e(__('account.password')); ?></label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control placeholder-no-fix" value="" placeholder="<?php echo e(__('account.password')); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"><?php echo e(__('account.password_confirm')); ?></label>
                            <div class="col-md-9">
                                <input type="password" name="password_confirmation" class="form-control placeholder-no-fix" value="" placeholder="<?php echo e(__('account.password_confirm')); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 pull-right">
                                <label class="mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="policy" <?php echo e(old('policy') ? 'checked' : ''); ?> /> <?php echo e(__('account.i_agree')); ?>

                                    <a href="javascript:;"><?php echo e(__('account.terms_of_service')); ?> </a> &
                                    <a href="javascript:;"><?php echo e(__('account.privacy_policy')); ?> </a>
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-actions row">
                            <div class="col-md-9 pull-right">
                                <a href="<?php echo e(route('frontend.login')); ?>" class="btn btn-default" data-target="#ajax-modal-login" data-toggle="modal" data-dismiss="modal"><?php echo e(__('account.back')); ?></a>
                                <button type="submit" class="btn btn-site pull-right"><?php echo e(__('account.register')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>