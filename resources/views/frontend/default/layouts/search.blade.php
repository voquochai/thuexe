<div class="search-modal modal fade text-center" id="searchModal">
    <div class="header-search-form">
        <form method="get" action="{{ url('/san-pham') }}">
            <input type="text" name="keyword" value="{{ Request::get('keyword') }}" placeholder="{{ __('site.search') }}">
            <button type="submit"><i class="pe-7s-search"></i></button>
        </form>
    </div>
</div>