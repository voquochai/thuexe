@php
    $colors = get_attributes('product_colors',$lang);
@endphp
<div class="sidebar">
    <div class="sidebar-widget mb-20">
        <h4 class="title">{{ __('site.category') }}</h4>
        @php
            Menu::resetMenu();
            Menu::setOption([
                'open'=>['<ul class="category">'],
                'baseurl' => url('/san-pham')
            ]);
            Menu::setMenu(get_categories('san-pham',$lang));
            echo Menu::getMenu(@$category->id);
        @endphp
    </div>
</div>