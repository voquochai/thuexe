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
    <link rel="stylesheet" href="<?php echo e(asset('public/admin/css/components.css')); ?>">
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
        <form class="login-form" role="form" method="POST" action="<?php echo e(route('qlyxe.login')); ?>">
            <?php echo e(csrf_field()); ?>

            <h3 class="form-title font-green uppercase">Đăng nhập</h3>
            <div class="row"><?php echo $__env->make('qlyxe.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
            <div class="form-group">
                <label for="email" class="control-label visible-ie8 visible-ie9">Email</label>
                <input type="text" class="form-control form-control-solid placeholder-no-fix" name="email" value="<?php echo e(old('email')); ?>" autocomplete="off" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="password" class="control-label visible-ie8 visible-ie9">Password</label>
                <input type="password" class="form-control form-control-solid placeholder-no-fix" name="password" autocomplete="off" placeholder="Password">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn green uppercase">Đăng nhập</button>
                <label class="rememberme check mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>Ghi nhớ
                    <span></span>
                </label>
                <a href="<?php echo e(route('qlyxe.password.request')); ?>" id="forget-password" class="forget-password">Quên mật khẩu?</a>
            </div>
            <div class="login-options">
                <h4>Hoặc đăng nhập bằng</h4>
                <ul class="social-icons">
                    <li>
                        <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
                    </li>
                    <li>
                        <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
                    </li>
                    <li>
                        <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
                    </li>
                    <li>
                        <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
                    </li>
                </ul>
            </div>
            <div class="create-account">
                <p>
                    <a href="<?php echo e(route('qlyxe.register')); ?>" id="register-btn" class="uppercase">Tạo tài khoản</a>
                </p>
            </div>
        </form>
    </div>
    <script src="<?php echo e(asset('public/packages/jquery.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/packages/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    
</body>
</html>