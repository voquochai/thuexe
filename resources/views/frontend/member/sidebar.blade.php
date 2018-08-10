<div class="sidebar">
    <div class="sidebar-widget mb-20">
        <h4 class="title">{{ auth()->guard('member')->user()->name }}</h4>
        <ul class="category">
            <li> <a href="{{ route('frontend.member.profile') }}"> {{ __('account.profile') }} </a> </li>
            <li> <a href=""> {{ __('account.notification') }} </a> </li>
            <li> <a href="{{ route('frontend.member.order') }}"> {{ __('account.order_management') }} </a> </li>
            <li> <a href=""> {{ __('account.delivery_address') }} </a> </li>
            <li> <a href="{{ route('frontend.home.viewed') }}"> {{ __('account.viewed') }} </a> </li>
            <li> <a href="{{ route('frontend.wishlist.index') }}"> {{ __('account.wishlist') }} </a> </li>
        </ul>
    </div>
</div>