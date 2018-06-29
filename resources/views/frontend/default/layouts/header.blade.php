<header class="header-section section">
    <div class="header-top">
        <div class="container">
            <div class="header-top-left">
                <ul>
                    <li> <a href="tel:{{ config('settings.site_hotline') }}"> <i class="pe-7s-phone"></i> <span class="hidden-xs">{{ config('settings.site_hotline') }}</span> </a> </li>
                    <li> <a href="mailto:{{ config('settings.site_email') }}"> <i class="pe-7s-mail-open"></i> <span class="hidden-xs">{{ config('settings.site_email') }}</span> </a> </li>
                </ul>
            </div>
            <div class="header-top-right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            @if ( auth()->guard('member')->check() )
                                {{ auth()->guard('member')->user()->name }}
                            @else
                            {{ __('account.account') }}
                            @endif
                        </a>
                        <ul>
                            @if ( auth()->guard('member')->check() )
                            <li>
                                <a href="{{ route('frontend.member.profile') }}">
                                    <i class="icon-user"></i> Thông tin </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="icon-key"></i> Thoát </a>
                                <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @else
                            <li><a href="{{ url('/login') }}"> {{ __('account.login') }} </a></li>
                            <li><a href="{{ url('/register') }}">  {{ __('account.register') }} </a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom sticker">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <div class="header-logo">
                        <a href="{{ url('/') }}"><img src="{{ (config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ? asset('public/uploads/photos/'.config('settings.logo')) : asset('noimage/190x30')) }}" alt="main logo"></a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6 float-right">
                    <div class="header-option-btns float-right">
                        <!-- Header-search -->
                        <div class="header-search float-left">
                            <button class="search-toggle" data-toggle="modal" data-target="#searchModal" ><i class="pe-7s-search"></i></button>
                        </div>
                    </div>
                </div>
                <!-- primary-menu -->
                <div class="col-md-8 col-xs-12">
                    @include('frontend.default.layouts.navbar')
                </div>
            </div>
        </div>
    </div>
</header>