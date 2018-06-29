<div class="sidebar">
    <div class="single-sidebar mb-40">
        <p class="text-center"> {{ __('account.account_of') }} </p>
        <h3 class="sidebar-title text-center">{{ auth()->guard('member')->user()->name }}</h3>
        <ul class="category-sidebar">
            <li> <a href="{{ route('frontend.member.profile') }}"> {{ __('account.profile') }} </a> </li>
            <li> <a href=""> {{ __('account.notification') }} </a> </li>
            <li> <a href="{{ route('frontend.member.order') }}"> {{ __('account.order_management') }} </a> </li>
            <li> <a href=""> {{ __('account.delivery_address') }} </a> </li>
            <li> <a href="{{ route('frontend.home.viewed') }}"> {{ __('account.viewed') }} </a> </li>
            <li> <a href="{{ route('frontend.wishlist.index') }}"> {{ __('account.wishlist') }} </a> </li>
        </ul>
    </div>
</div>