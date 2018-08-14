<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administrator - {{ config('settings.site_name') }} </title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all">
    <link rel="stylesheet" href="{{ asset('public/packages/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/simple-line-icons/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-switch/css/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-fileinput/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-select/css/bootstrap-select.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-daterangepicker/daterangepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap-modal/css/bootstrap-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/select2/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/form-validation/css/validationEngine.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/jquery-filer/jquery.filer.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/yoast-seo/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/yoast-seo/yoast-seo.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/qlyxe/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('public/qlyxe/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('public/qlyxe/css/profile.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/qlyxe/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('public/qlyxe/css/themes/darkblue.css') }}">
    <link rel="stylesheet" href="{{ asset('public/qlyxe/css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('public/uploads/photos/'.config('settings.favicon')) }}" />
    @yield('custom_css')
    
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
    @include('qlyxe.layouts.header')
    <div class="clearfix"> </div>
    <div class="page-container">
        @include('qlyxe.layouts.sidebar')
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="{{ route('qlyxe.dashboard.index') }}"> <i class="icon-home"></i> </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        @yield('breadcrumb')
                    </ul>
                    @if(Route::currentRouteName() == 'qlyxe.dashboard.index')
                    <div class="page-toolbar">
                        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs"></span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>
                    @endif
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    @include('qlyxe.layouts.footer')

    <script>
        @php
        $routeArray = explode('.',Route::currentRouteName());
        $routeName = $routeArray[1].( isset($_GET['type']) ? '.'.$_GET['type'] : '');
        $routeAction = @$routeArray[2];
        @endphp
        window.Laravel = {!! json_encode([
            'csrfToken' =>  csrf_token(),
            'baseUrl'   =>  url('/'),
            'routeName'   =>  $routeName,
        ]) !!}
    </script>
    <script src="{{ asset('public/jsons/province.json') }}"></script>
    <script src="{{ asset('public/jsons/district.json') }}"></script>

    <script src="{{ asset('public/packages/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/jquery.price_format.2.0.js') }}" type="text/javascript"></script>

    <script src="{{ asset('public/packages/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('public/packages/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/form-validation/js/languages/jquery.validationEngine-vi.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/form-validation/js/jquery.validationEngine.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/jquery-filer/jquery.filer.js') }}" type="text/javascript"></script>

    @if($routeName == 'dashboard')
    <script src="{{ asset('public/packages/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
    @endif

    @if($routeAction == 'create' || $routeAction == 'edit')
    <script src="{{ asset('public/packages/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/ckeditor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/yoast-seo/example-b.js') }}" type="text/javascript"></script>
    @endif

    <script src="{{ asset('public/qlyxe/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/qlyxe/js/layout.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/qlyxe/js/qlyxe.js') }}" type="text/javascript"></script>
    @yield('custom_script')
</body>
</html>