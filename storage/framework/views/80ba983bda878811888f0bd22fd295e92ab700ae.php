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
        <form class="login-form" role="form" method="POST" action="<?php echo e(route('frontend.login')); ?>">
            <?php echo e(csrf_field()); ?>

            <h3 class="form-title"> <?php echo e(__('site.member')); ?> </h3>
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