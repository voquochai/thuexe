<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<div class="modal-body">
    <div class="login-wrap">
        <div class="row">
            <div class="col-md-4 logo">
                <div>
                    <h4 class="form-title"><?php echo e(__('site.member')); ?></h4></div>
            </div>
            <div class="col-md-8">
                <div class="content">
                    <form class="login-form" role="form" method="POST" action="<?php echo e(route('frontend.login')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="row"><?php echo $__env->make('admin.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
                        <div class="form-group">
                            <label for="email" class="control-label visible-ie8 visible-ie9">Email</label>
                            <input type="text" class="form-control placeholder-no-fix" name="email" value="<?php echo e(old('email')); ?>" autocomplete="off" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label visible-ie8 visible-ie9">Password</label>
                            <input type="password" class="form-control placeholder-no-fix" name="password" autocomplete="off" placeholder="Password">
                        </div>

                        <div class="form-actions">
                            <div>
                                <label class="rememberme check mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>><?php echo e(__('account.remember')); ?>

                                    <span></span>
                                </label>
                                <button type="submit" class="btn green pull-right"><?php echo e(__('account.login')); ?></button>
                                
                            </div>
                            
                        </div>
                        <div class="login-options">
                            <h4><?php echo e(__('account.or_login_by')); ?></h4>
                            <ul class="social-icons">
                                <li>
                                    <a class="facebook" data-original-title="facebook" href="<?php echo e(route('login.facebook')); ?>"> </a>
                                </li>
                                <li>
                                    <a class="googleplus" data-original-title="Goole Plus" href="javascript:;"> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="forget-password">
                            <h4><?php echo e(__('account.forgot_password')); ?></h4>
                            <p> <?php echo __('account.click_here',['attribute'=>route('frontend.password.request')]); ?> </p>
                        </div>
                        <div class="create-account">
                            <p> <?php echo __('account.no_account',['attribute'=>route('frontend.register')]); ?> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>