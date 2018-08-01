<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>
        <?php echo e(config('app.name', 'Laravel')); ?>

    </title>

    <!-- Styles -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all">
    <link rel="stylesheet" href="<?php echo e(asset('public/packages/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/packages/simple-line-icons/simple-line-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/packages/bootstrap/css/bootstrap.min.css')); ?>">
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo e(asset('public/admin/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/admin/css/plugins.css')); ?>">
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link rel="stylesheet" href="<?php echo e(asset('public/css/login.css')); ?>">
    <!-- END THEME LAYOUT STYLES -->
    <link href="<?php echo e(asset('public/uploads/photos/'.config('settings.favicon'))); ?>" rel="shortcut icon" type="image/x-icon" />
</head>
<body class="login">
    <div class="logo">
        <a href="<?php echo e(url('/')); ?>"> <img src="<?php echo e(asset('public/images/logo-white.png')); ?>" alt="" /> </a>
    </div>
    <div class="content">
        <form class="register-form" role="form" method="POST" action="<?php echo e(route('frontend.register')); ?>">
            <?php echo e(csrf_field()); ?>

            <h3><?php echo e(__('account.create_account')); ?></h3>
            <p class="hint"> <?php echo e(__('account.enter_personal_details')); ?>: </p>
            <div class="row"><?php echo $__env->make('admin.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9"><?php echo e(__('account.name')); ?></label>
                <div>
                    <input type="text" name="name" class="form-control placeholder-no-fix" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('account.name')); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div>
                    <input type="text" name="email" class="form-control placeholder-no-fix" value="<?php echo e(old('email')); ?>" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9"><?php echo e(__('account.phone')); ?></label>
                <div>
                    <input type="text" name="phone" class="form-control placeholder-no-fix" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('account.phone')); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9"><?php echo e(__('account.address')); ?></label>
                <div>
                    <input type="text" name="address" class="form-control placeholder-no-fix" value="<?php echo e(old('address')); ?>" placeholder="<?php echo e(__('account.address')); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9"><?php echo e(__('account.username')); ?></label>
                <div>
                    <input type="text" name="username" class="form-control placeholder-no-fix" value="<?php echo e(old('username')); ?>" placeholder="<?php echo e(__('account.username')); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9"><?php echo e(__('account.password')); ?></label>
                <div>
                    <input type="password" name="password" class="form-control placeholder-no-fix" value="" placeholder="<?php echo e(__('account.password')); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9"><?php echo e(__('account.password_confirm')); ?></label>
                <div>
                    <input type="password" name="password_confirmation" class="form-control placeholder-no-fix" value="" placeholder="<?php echo e(__('account.password_confirm')); ?>">
                </div>
            </div>

            <div class="form-group margin-top-20 margin-bottom-20">
                <label class="mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="policy" <?php echo e(old('policy') ? 'checked' : ''); ?> /> <?php echo e(__('account.i_agree')); ?>

                    <a href="javascript:;"><?php echo e(__('account.terms_of_service')); ?> </a> &
                    <a href="javascript:;"><?php echo e(__('account.privacy_policy')); ?> </a>
                    <span></span>
                </label>
            </div>

            <div class="form-actions">
                <a href="<?php echo e(route('frontend.login')); ?>" class="btn grey-salsa btn-outline"><?php echo e(__('account.back')); ?></a>
                <button type="submit" class="btn green pull-right"><?php echo e(__('account.register')); ?></button>
            </div>
        </form>
    </div>

    <!-- SCRIPT -->
    <script>
        <?php 
        $routeArray = explode('.',Route::currentRouteName());
        $routeName = $routeArray[1].'.'.( isset($_GET['type']) ? $_GET['type'] : '');
         ?>
        window.Laravel = <?php echo json_encode([
            'csrfToken' =>  csrf_token(),
            'baseUrl'   =>  url('/'),
            'routeName'   =>  $routeName,
        ]); ?>

    </script>
    <!-- BEGIN CORE PLUGINS -->
    <script src="<?php echo e(asset('public/packages/jquery.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/packages/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(asset('public/admin/js/app.js')); ?>" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    
</body>
</html>