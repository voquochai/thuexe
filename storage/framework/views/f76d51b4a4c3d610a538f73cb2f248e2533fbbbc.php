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
        <form class="register-form" action="<?php echo e(route('qlyxe.register')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <h3 class="font-green uppercase">Đăng ký</h3>
            <p class="hint"> Thông tin cá nhân</p>
            <div class="row"><?php echo $__env->make('qlyxe.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Họ và Tên</label>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Họ và Tên" name="name" value="<?php echo e(old('name')); ?>" > </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Điện thoại</label>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Điện thoại" name="phone" value="<?php echo e(old('phone')); ?>"> </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Địa chỉ</label>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Địa chỉ" name="address" value="<?php echo e(old('address')); ?>"> </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Tỉnh / Thành</label>
                <select class="form-control province" name="province_id">
                    <?php echo old('province_id') ? '<option value="'.old('province_id').'" selected ></option>' : ''; ?>

                </select> </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Quận / Huyện</label>
                <select class="form-control district" name="district_id">
                    <?php echo old('district_id') ? '<option value="'.old('district_id').'" selected ></option>' : ''; ?>

                </select> </div>
            <p class="hint"> Thông tin đăng nhập: </p>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>"> </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Mật khẩu</label>
                <input class="form-control placeholder-no-fix valid" type="password" autocomplete="off" id="register_password" placeholder="Mật khẩu" name="password"> </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Xác nhận mật khẩu</label>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Xác nhận mật khẩu" name="password_confirmation"> </div>
            <div class="form-group margin-top-20 margin-bottom-20">
                <label class="check mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="policy" <?php echo e(old('policy') ? 'checked' : ''); ?> > Tôi đồng ý với
                    <a href="javascript:;"> Điều khoản dịch vụ </a> &amp;
                    <a href="javascript:;"> Chính sách bảo mật </a>
                    <span></span>
                </label>
            </div>
            <div class="form-actions">
                <a href="<?php echo e(route('qlyxe.login')); ?>" id="register-back-btn" class="btn btn-default">Quay lại</a>
                <button type="submit" id="register-submit-btn" class="btn green uppercase pull-right">Đăng ký</button>
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
    <script src="<?php echo e(asset('public/jsons/province.json')); ?>"></script>
    <script src="<?php echo e(asset('public/jsons/district.json')); ?>"></script>
    <script src="<?php echo e(asset('public/packages/jquery.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/packages/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript">
        var simpleProvince = $('.simple-province').attr('data-key');
        var simpleDistrict = $('.simple-district').attr('data-key');
        if(simpleProvince){
            $('.simple-province').html(province[simpleProvince].name);
            $('.simple-district').html(district[simpleProvince][simpleDistrict].name);
        }
        
        var listProvince = ['<option value="0"> -- Chọn Tỉnh / Thành phố --</option>'];
        var curProvince = $('select.province').val();
        var curDistrict = $('select.district').val();
        $.each( province, function( key, val ) {
            listProvince.push('<option value="'+key+'" '+ ( key == curProvince ? 'selected' : '' ) +'>'+val.name+'</option>');
        });
        $('select.province').html(listProvince.join("")).on('change', function(){
            var province_id = $(this).val();
            var listDistrict = ['<option value="0"> -- Chọn Quận / Huyện --</option>'];
            $.each( district[province_id], function( key, val ) {
                listDistrict.push('<option value="'+key+'" '+ ( key == curDistrict ? 'selected' : '' ) +'>'+val.name+'</option>');
            });
            $('select.district').html(listDistrict.join(""));
        }).change();
    </script>
    
</body>
</html>