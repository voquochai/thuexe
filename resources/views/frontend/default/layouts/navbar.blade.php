<nav class="main-menu text-center">
    <ul>
        <li {!! (Route::currentRouteName() == 'home.index') ? 'class="active"' : '' !!} ><a href="{{ url('/') }}"> {{ __('site.home') }} </a></li>
        <li {!! ($type == 'hosting') ? 'class="active"' : '' !!} ><a href="{{ url('/hosting') }}"> Hosting </a></li>
        <li {!! ($type == 'san-pham') ? 'class="active"' : '' !!} ><a href="{{ url('/san-pham') }}"> Kho web </a>
            @php
                Menu::resetMenu();
                Menu::setOption([
                    'open'=>['<ul class="sub-menu">','<ul>'],
                    'baseurl' => url('/san-pham')
                ]);
                Menu::setMenu(get_categories('san-pham',$lang));
                echo Menu::getMenu();
            @endphp
        </li>
        <li {!! ($type == 'dich-vu') ? 'class="active"' : '' !!} ><a href="{{ url('/dich-vu') }}"> Dịch vụ </a>
            @php
                Menu::resetMenu();
                Menu::setOption([
                    'open'=>['<ul class="sub-menu">'],
                    'baseurl' => url('/dich-vu')
                ]);
                Menu::setMenu(get_categories('dich-vu',$lang));
                echo Menu::getMenu();
            @endphp
        </li>
        <li {!! ($type == 'thu-thuat') ? 'class="active"' : '' !!} ><a href="{{ url('/thu-thuat') }}"> Thủ thuật </a>
            @php
                Menu::resetMenu();
                Menu::setOption([
                    'open'=>['<ul class="sub-menu">'],
                    'baseurl' => url('/thu-thuat')
                ]);
                Menu::setMenu(get_categories('thu-thuat',$lang));
                echo Menu::getMenu();
            @endphp
        </li>
        <li {!! (Route::currentRouteName() == 'frontend.home.contact') ? 'class="active"' : '' !!} ><a href="{{ url('/lien-he') }}"> {{ __('site.contact') }} </a></li>
    </ul>
</nav>
<div class="mobile-menu"></div>