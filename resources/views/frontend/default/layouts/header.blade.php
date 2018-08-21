<header class="header-section">
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
                        <a href="javascript:;">
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
                                <a href="{{ route('frontend.member.profile') }}"> {{ __('account.profile') }} </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('account.exit') }} </a>
                                <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @else
                            <li><a href="#ajax-modal-login" data-toggle="modal"> {{ __('account.login') }} </a></li>
                            <li><a href="#ajax-modal-register" data-toggle="modal" > {{ __('account.register') }} </a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="header-logo">
                        @if(Route::currentRouteName() == 'frontend.home.index')
                        <h1><a href="{{ url('/') }}"><img src="{{ (config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ? asset('public/uploads/photos/'.config('settings.logo')) : asset('noimage/190x30')) }}" alt="Logo"><strong>{{ config('settings.site_name') }}</strong></a></h1>
                        @else
                        <h2><a href="{{ url('/') }}"><img src="{{ (config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ? asset('public/uploads/photos/'.config('settings.logo')) : asset('noimage/190x30')) }}" alt="main logo"><strong>{{ config('settings.site_name') }}</strong></a></h2>
                        @endif
                    </div>
                    <div class="header-option-btns sticker">
                        <!-- Header-search -->
                        <div class="header-search float-left">
                            <button class="search-toggle" data-toggle="modal" data-target="#searchModal" ><i class="pe-7s-search"></i></button>
                        </div>
                        <div class="header-cart float-left">
                            <!-- Cart Toggle -->
                            <a class="cart-toggle" href="javascript:;">
                                <i class="pe-7s-cart"></i>
                                <span class="countCart"></span>
                            </a>
                            <!-- Mini Cart Brief -->
                            <div class="mini-cart">
                                <div class="cart-top">
                                    <p>{!! __('cart.has_item',['attribute'=>0]) !!}</p>
                                </div>
                                <!-- Cart Products -->
                                <div class="cart-items clearfix"></div>
                                <!-- Cart Total -->
                                <div class="cart-total">
                                    <p>{{ __('cart.total') }} <span class="float-right sumOrderPrice"></span></p>
                                </div>
                                <!-- Cart Button -->
                                <div class="cart-bottom clearfix">
                                    <a href="{{ route('frontend.cart.index') }}" class="btn btn-site float-left">{{ __('site.cart') }}</a>
                                    <a href="{{ route('frontend.cart.checkout') }}" class="btn btn-site float-right">{{ __('site.checkout') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>