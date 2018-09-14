<div class="modal fade" id="ajax-modal-login" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <div class="modal-body">
                <div class="login-wrap">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 logo hidden-sm hidden-xs">
                            <div>
                                <h4 class="form-title"><?php echo e(__('account.login')); ?></h4></div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="content">
                                <form class="login-form" role="form" method="POST" action="<?php echo e(route('frontend.login')); ?>">
                                    <div class="form-group row">
                                        <label for="email" class="control-label col-md-3">Email</label>
                                        <div class="col-md-9 col-sm-12 col-xs-12"><input type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" autocomplete="off" placeholder="Email"></div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="control-label col-md-3"><?php echo e(__('account.password')); ?></label>
                                        <div class="col-md-9 col-sm-12 col-xs-12"><input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password"></div>
                                    </div>

                                    <div class="form-actions row">
                                        <div class="col-md-9 col-sm-12 col-xs-12 pull-right">
                                            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>><?php echo e(__('account.remember')); ?>

                                                <span></span>
                                            </label>
                                            <button type="button" class="btn btn-login btn-site pull-right"><?php echo e(__('account.login')); ?></button>
                                        </div>
                                    </div>

                                    <div class="login-options row">
                                        <div class="col-md-9 col-sm-12 col-xs-12 pull-right">
                                            <h4><?php echo e(__('account.or_login_by')); ?></h4>
                                            <ul class="social-icons">
                                                <li>
                                                    <a class="btn btn-block btn-social btn-facebook" data-original-title="facebook" href="<?php echo e(route('login.facebook')); ?>">
                                                        <i class="fa fa-facebook"></i>
                                                        <?php echo e(__('account.sign_in_with_facebook')); ?>

                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-block btn-social btn-google" data-original-title="Goole Plus" href="javascript:;">
                                                        <i class="fa fa-google"></i>
                                                        <?php echo e(__('account.sign_in_with_google')); ?>

                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="forget-password">
                                                <h4><?php echo e(__('account.forgot_password')); ?></h4>
                                                <p> <?php echo __('account.click_here'); ?> </p>
                                            </div>
                                            <div class="create-account">
                                                <p> <?php echo __('account.no_account'); ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajax-modal-register" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <div class="modal-body">
                <div class="login-wrap">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 logo hidden-sm hidden-xs">
                            <div>
                                <h4 class="form-title"><?php echo e(__('account.create_account')); ?></h4></div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="content">
                                <form class="register-form" role="form" method="POST" action="<?php echo e(route('frontend.register')); ?>">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"><?php echo e(__('account.name')); ?></label>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('account.name')); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"><?php echo e(__('account.phone')); ?></label>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('account.phone')); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"><?php echo e(__('account.address')); ?></label>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <input type="text" name="address" class="form-control" value="<?php echo e(old('address')); ?>" placeholder="<?php echo e(__('account.address')); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Email</label>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <input type="text" name="email" class="form-control" value="<?php echo e(old('email')); ?>" placeholder="Email">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"><?php echo e(__('account.password')); ?></label>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <input type="password" name="password" class="form-control" value="" placeholder="<?php echo e(__('account.password')); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3"><?php echo e(__('account.password_confirm')); ?></label>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <input type="password" name="password_confirmation" class="form-control" value="" placeholder="<?php echo e(__('account.password_confirm')); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-9 col-sm-12 col-xs-12 pull-right">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" name="policy" <?php echo e(old('policy') ? 'checked' : ''); ?> /> <?php echo e(__('account.i_agree')); ?>

                                                <a href="javascript:;"><?php echo e(__('account.terms_of_service')); ?> </a> &
                                                <a href="javascript:;"><?php echo e(__('account.privacy_policy')); ?> </a>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-actions row">
                                        <div class="col-md-9 col-sm-12 col-xs-12 pull-right">
                                            <a href="#ajax-modal-login" class="btn btn-default" data-toggle="modal" data-dismiss="modal"><?php echo e(__('account.back')); ?></a>
                                            <button type="button" class="btn btn-register btn-site pull-right"><?php echo e(__('account.register')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>