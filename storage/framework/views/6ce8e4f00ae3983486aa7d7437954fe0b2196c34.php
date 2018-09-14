<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Quản trị website')); ?></title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all">
    <link rel="stylesheet" href="<?php echo e(asset('public/packages/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/packages/simple-line-icons/simple-line-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/packages/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/packages/bootstrap-switch/css/bootstrap-switch.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/qlyxe/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/qlyxe/css/plugins.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/qlyxe/css/login.css')); ?>">
    <link href="<?php echo e(asset('public/uploads/photos/'.config('settings.favicon'))); ?>" rel="shortcut icon" type="image/x-icon" />
</head>
<body class="login">
    <div class="logo">
        <?php if( config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ): ?>
        <a href="<?php echo e(url('/')); ?>"> <img src="<?php echo e(asset('public/uploads/photos/'.config('settings.logo'))); ?>" alt="main logo"> </a>
        <?php endif; ?>
    </div>
    <div class="content">
        <form class="forget-form" role="form" method="POST" action="<?php echo e(route('qlyxe.password.email')); ?>">
            <?php echo e(csrf_field()); ?>

            <h3 class="form-title font-green uppercase">Quên mật khẩu</h3>
            <p> Nhập địa chỉ Email của bạn để đặt lại mật khẩu </p>
            <div class="row"><?php echo $__env->make('qlyxe.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
            <div class="form-group">
                <label for="email" class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
                <input id="email" type="email" class="form-control form-control-solid placeholder-no-fix" name="email" value="<?php echo e(old('email')); ?>" autocomplete="off" placeholder="Email">
            </div>
            <div class="form-actions">
                <a href="<?php echo e(route('qlyxe.login')); ?>" class="btn btn-default">Quay lại</a>
                <button type="submit" class="btn green uppercase pull-right"> Gửi mật khẩu </button>
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
    <script src="<?php echo e(asset('public/packages/bootstrap-switch/js/bootstrap-switch.min.js')); ?>" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(asset('public/qlyxe/js/app.js')); ?>" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
</body>
</html>