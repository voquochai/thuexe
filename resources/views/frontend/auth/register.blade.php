<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Styles -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all">
    <link rel="stylesheet" href="{{ asset('public/packages/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/simple-line-icons/simple-line-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/packages/bootstrap/css/bootstrap.min.css') }}">
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/plugins.css') }}">
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link rel="stylesheet" href="{{ asset('public/css/login.css') }}">
    <!-- END THEME LAYOUT STYLES -->
    <link href="{{ asset('public/uploads/photos/'.config('settings.favicon')) }}" rel="shortcut icon" type="image/x-icon" />
</head>
<body class="login">
    <div class="logo">
        <a href="{{ url('/') }}"> <img src="{{ asset('public/images/logo-white.png') }}" alt="" /> </a>
    </div>
    <div class="content">
        <form class="register-form" role="form" method="POST" action="{{ route('frontend.register') }}">
            {{ csrf_field() }}
            <h3>{{ __('account.create_account') }}</h3>
            <p class="hint"> {{ __('account.enter_personal_details') }}: </p>
            <div class="row">@include('admin.blocks.messages')</div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">{{ __('account.name') }}</label>
                <div>
                    <input type="text" name="name" class="form-control placeholder-no-fix" value="{{ old('name') }}" placeholder="{{ __('account.name') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div>
                    <input type="text" name="email" class="form-control placeholder-no-fix" value="{{ old('email') }}" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">{{ __('account.phone') }}</label>
                <div>
                    <input type="text" name="phone" class="form-control placeholder-no-fix" value="{{ old('phone') }}" placeholder="{{ __('account.phone') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">{{ __('account.address') }}</label>
                <div>
                    <input type="text" name="address" class="form-control placeholder-no-fix" value="{{ old('address') }}" placeholder="{{ __('account.address') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">{{ __('account.username') }}</label>
                <div>
                    <input type="text" name="username" class="form-control placeholder-no-fix" value="{{ old('username') }}" placeholder="{{ __('account.username') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">{{ __('account.password') }}</label>
                <div>
                    <input type="password" name="password" class="form-control placeholder-no-fix" value="" placeholder="{{ __('account.password') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">{{ __('account.password_confirm') }}</label>
                <div>
                    <input type="password" name="password_confirmation" class="form-control placeholder-no-fix" value="" placeholder="{{ __('account.password_confirm') }}">
                </div>
            </div>

            <div class="form-group margin-top-20 margin-bottom-20">
                <label class="mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="policy" {{ old('policy') ? 'checked' : '' }} /> {{ __('account.i_agree') }}
                    <a href="javascript:;">{{ __('account.terms_of_service') }} </a> &
                    <a href="javascript:;">{{ __('account.privacy_policy') }} </a>
                    <span></span>
                </label>
            </div>

            <div class="form-actions">
                <a href="{{ route('frontend.login') }}" class="btn grey-salsa btn-outline">{{ __('account.back') }}</a>
                <button type="submit" class="btn green pull-right">{{ __('account.register') }}</button>
            </div>
        </form>
    </div>

    <!-- SCRIPT -->
    <script>
        @php
        $routeArray = explode('.',Route::currentRouteName());
        $routeName = $routeArray[1].'.'.( isset($_GET['type']) ? $_GET['type'] : '');
        @endphp
        window.Laravel = {!! json_encode([
            'csrfToken' =>  csrf_token(),
            'baseUrl'   =>  url('/'),
            'routeName'   =>  $routeName,
        ]) !!}
    </script>
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('public/packages/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/packages/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('public/admin/js/app.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    
</body>
</html>