@php
    $socials = get_links('social',$lang);
    $banks = get_photos('bank',$lang);
    $chinhsach = get_posts('chinh-sach-quy-dinh',$lang);
    $hotro = get_posts('ho-tro-khach-hang',$lang);
    $footer = get_pages('footer',$lang);
@endphp
<!-- FOOTER SECTION START -->
<footer class="footer-section">
    <div class="footer-top pt-40">
        <div class="container">
            <div class="row">
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-12 col-xs-12 mb-40">
                    <div class="logo mb-20">
                        <a href="index.html"><img src="{{ (config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ? asset('public/uploads/photos/'.config('settings.logo')) : asset('noimage/170x55')) }}" alt="logo"></a>
                    </div>
                    {!! @$footer->contents !!}
                    <div class="footer-social fix">
                        @forelse($socials as $link)
                        <a href="{{ $link->link }}"> {!! $link->icon !!} </a>
                        @empty
                        @endforelse
                    </div>
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-6 col-xs-6 col-xs-wide mb-40">
                    <h4 class="widget-title">Chính sách &amp; Quy định</h4>
                    <ul>
                        @forelse($chinhsach as $val)
                        <li><a href="{{ route('frontend.home.page',['type'=>$val->type, 'slug'=>$val->slug]) }}">{{$val->title}}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-6 col-xs-6 col-xs-wide mb-40">
                    <h4 class="widget-title">Hỗ trợ khách hàng</h4>
                    <ul>
                        @forelse($hotro as $val)
                        <li><a href="{{ route('frontend.home.page',['type'=>$val->type, 'slug'=>$val->slug]) }}">{{$val->title}}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-12 col-xs-12 mb-40">
                    <h4 class="widget-title">{{ __('site.newsletter') }}</h4>
                    @include('frontend.default.layouts.newsletter')
                    <!-- Footer Social -->
                    
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER TOP SECTION END -->  

    <!-- FOOTER BOTTOM SECTION START -->
    <div class="footer-bottom ptb-20">
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="copyright text-center col-xs-12">
                    <p>{{ config('settings.site_copyright') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER BOTTOM SECTION END -->