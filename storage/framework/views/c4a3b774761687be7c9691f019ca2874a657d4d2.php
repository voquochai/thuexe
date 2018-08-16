<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8" />
        <title><?php echo e(config('app.name')); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" href="<?php echo e(asset('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('public/packages/font-awesome/css/font-awesome.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('public/packages/simple-line-icons/simple-line-icons.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('public/packages/bootstrap/css/bootstrap.min.css')); ?>">
        <!-- END GLOBAL MANDATORY STYLES -->
        
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link rel="stylesheet" href="<?php echo e(asset('public/admin/css/components.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('public/admin/css/plugins.css')); ?>">
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link rel="stylesheet" href="<?php echo e(asset('public/css/error.css')); ?>">
        <link href="<?php echo e(asset('public/uploads/photos/'.config('settings.favicon'))); ?>" rel="shortcut icon" type="image/x-icon" />
    </head>
    <!-- END HEAD -->

    <body class="page-404-full-page">
        <div class="row">
            <div class="col-md-12 page-404">
                <div class="number font-red"> 404 </div>
                <div class="details">
                    <h3><?php echo e(__('site.oops')); ?>.</h3>
                    <p> <?php echo e(__('site.can_not_find')); ?>.
                    <br/>
                    <a href="<?php echo e(url('/')); ?>"> <?php echo e(__('site.return_home')); ?> </a> <?php echo e(__('site.or_try')); ?>. </p>
                    <form method="get" action="<?php echo e(url('/san-pham')); ?>">
                        <div class="input-group input-medium">
                            <input type="text" class="form-control" placeholder="keyword...">
                            <span class="input-group-btn">
                                <button type="submit" class="btn red">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>