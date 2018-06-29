@php
    $socials = get_links('social',$lang);
    $banks = get_photos('bank',$lang);
    $chinhsach = get_posts('chinh-sach-quy-dinh',$lang);
    $hotro = get_posts('ho-tro-khach-hang',$lang);
    $footer = get_pages('footer',$lang);
@endphp
<!-- FOOTER SECTION START -->
<footer class="footer-section section ptb-60">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-6 col-xs-12 mb-40">
                    <div class="logo mb-20">
                        <a href="index.html"><img src="{{ (config('settings.logo') && file_exists(public_path('/uploads/photos/'.config('settings.logo'))) ? asset('public/uploads/photos/'.config('settings.logo')) : asset('noimage/170x55')) }}" alt="logo"></a>
                    </div>
                    {!! @$footer->contents !!}
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-6 col-xs-12 mb-40">
                    <h4 class="widget-title">Chính sách &amp; Quy định</h4>
                    <ul>
                        @forelse($chinhsach as $val)
                        <li><a href="{{ route('frontend.home.page',['type'=>$val->type, 'slug'=>$val->slug]) }}">{{$val->title}}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-6 col-xs-12 mb-40">
                    <h4 class="widget-title">Hỗ trợ khách hàng</h4>
                    <ul>
                        @forelse($hotro as $val)
                        <li><a href="{{ route('frontend.home.page',['type'=>$val->type, 'slug'=>$val->slug]) }}">{{$val->title}}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <!-- Footer Widget -->
                <div class="footer-widget col-md-3 col-sm-6 col-xs-12 mb-40">
                    <h4 class="widget-title">{{ __('site.newsletter') }}</h4>
                    @include('frontend.default.layouts.newsletter')
                    <!-- Footer Social -->
                    <div class="footer-social fix">
                        @forelse($socials as $link)
                        <a href="{{ $link->link }}"> {!! $link->icon !!} </a>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER TOP SECTION END -->  

    <!-- FOOTER BOTTOM SECTION START -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="copyright text-left col-sm-6 col-xs-12">
                    <p>{{ config('settings.site_copyright') }}</p>
                </div>
                <!-- Payment Method -->
                <div class="payment-method text-right col-sm-6 col-xs-12">
                    @forelse($banks as $bank)
                    <img src="{{ asset('public/uploads/photos/'.get_thumbnail($bank->image)) }}" alt="{{ $bank->alt }}" />
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER BOTTOM SECTION END -->