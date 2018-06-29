@extends('frontend.default.master')
@section('content')
<!-- CRITERIA SECTION START -->
<section class="criteria-section section ptb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row">
            <div class="section-title text-center col-xs-12 mb-70">
                <h2> Tại sao chọn <span> Kho Web Online ?</span> </h2>
            </div>
        </div>
        <div class="row display-flex">
            @forelse($criteria as $val)
                {!! get_template_single_post($val,'bai-viet',3) !!}
            @empty
            @endforelse
        </div>
    </div>
</section>
<!-- CRITERIA SECTION END -->

<!-- PRODUCT SECTION START -->
<section class="product-section section ptb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row">
            <div class="section-title text-center col-xs-12 mb-70">
                <h2> Kho web <span> Chuẩn Seo </span> </h2>
            </div>
        </div>
        <div class="row display-flex">
            @forelse($new_products as $val)
                {!! get_template_product($val,'san-pham',3) !!}
            @empty
            @endforelse
        </div>
    </div>
</section>
<!-- PRODUCT SECTION END -->

<!-- PRICING TABLE SECTION START -->
<section class="pricing-table-section section ptb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2><span>Bảng giá</span> dịch vụ </h2>
                </div>
            </div>
        </div>

        <div class="row display-flex">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-pricing-table">
                    <h2>Cá nhân</h2>
                    <img src="{{ asset('public/themes/default/images/pricing/pricing-icon-2.png') }}" alt="pricing-icon">
                    <div class="pricing-amount">
                        <span class="price">1.000.000</span>
                        <sup><span class="currency">đ</span></sup>
                        <span class="subscription"> / 1 năm </span>
                    </div>
                    <div class="pricing-content">
                        <ul>
                            <li>Dung lượng <span>1GB</span></li>
                            <li>Băng thông <span>30GB</span></li>
                            <li>Địa chỉ Email <span>5</span></li>
                            <li>Park/ Addon Domain <span>1</span></li>
                            <li>Giao diện website <span>1</span></li>
                            <li>Upload dữ liệu <b class="fa fa-question-circle tooltips" data-style="default" data-container="body" data-placement="bottom" data-original-title="Không hỗ trợ upload dữ liệu, chỉnh sửa hình ảnh, nội dung"></b> <i class="fa fa-close fa-fw"></i></li>
                            <li>Chỉnh sửa giao diện <i class="fa fa-close fa-fw"></i></li>
                            <li>Sao lưu dữ liệu <b class="fa fa-question-circle tooltips" title="Sao lưu 1 lần vào cuối tháng"></b> <span>1 / Tháng</span></li>
                            <li>Hỗ trợ 24/7 <i class="fa fa-check fa-fw"></i></li>
                        </ul>
                        <a class="pricing-btn blue-btn" href="#"> Đăng ký </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-pricing-table blue">
                    <h2>Doanh nghiệp</h2>
                    <img src="{{ asset('public/themes/default/images/pricing/pricing-icon-4.png') }}" alt="pricing-icon">
                    <div class="pricing-amount">
                        <span class="price">3.000.000</span>
                        <sup><span class="currency">đ</span></sup>
                        <span class="subscription"> / 1 năm </span>
                    </div>
                    <div class="pricing-content">
                        <ul>
                            <li>Dung lượng <span>4GB</span></li>
                            <li>Băng thông <span>120GB</span></li>
                            <li>Địa chỉ Email <span>4</span></li>
                            <li>Park/ Addon Domain <span>4</span></li>
                            <li>Giao diện website <span>2</span></li>
                            <li>Upload dữ liệu <b class="fa fa-question-circle tooltips" data-style="default" data-container="body" data-placement="bottom" data-original-title="Hỗ trợ upload 100 sản phẩm, 50 bài viết và chỉnh sửa hình ảnh"></b> <i class="fa fa-check fa-fw"></i></li>
                            <li>Chỉnh sửa giao diện <i class="fa fa-check fa-fw"></i></li>
                            <li>Sao lưu dữ liệu <b class="fa fa-question-circle tooltips" data-style="default" data-container="body" data-placement="bottom" data-original-title="Sao lưu 2 lần vào giữa và cuối tháng"></b> <span>2 / Tháng</span></li>
                            <li>Hỗ trợ 24/7 <i class="fa fa-check fa-fw"></i></li>
                        </ul>
                        <a class="pricing-btn blue-btn" href="#"> Đăng ký </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-pricing-table">
                    <h2>Thương mại</h2>
                    <img src="{{ asset('public/themes/default/images/pricing/pricing-icon-3.png') }}" alt="pricing-icon">
                    <div class="pricing-amount">
                        <span class="price">5.000.000</span>
                        <sup><span class="currency">đ</span></sup>
                        <span class="subscription"> / 1 năm </span>
                    </div>
                    <div class="pricing-content">
                        <ul>
                            <li>Dung lượng <span>7GB</span></li>
                            <li>Băng thông <span>Unlimited</span></li>
                            <li>Địa chỉ Email <span>7</span></li>
                            <li>Park/ Addon Domain <span>7</span></li>
                            <li>Giao diện website <span>3</span></li>
                            <li>Upload dữ liệu <b class="fa fa-question-circle tooltips" data-style="default" data-container="body" data-placement="bottom" data-original-title="Hỗ trợ upload 500 sản phẩm, 100 bài viết và chỉnh sửa hình ảnh"></b> <i class="fa fa-check fa-fw"></i></li>
                            <li>Chỉnh sửa giao diện <i class="fa fa-check fa-fw"></i></li>
                            <li>Sao lưu dữ liệu <b class="fa fa-question-circle tooltips" data-style="default" data-container="body" data-placement="bottom" data-original-title="Sao lưu 3 lần vào ngày 5, 15, 25 hàng tháng"></b> <span>3 / Tháng</span></li>
                            <li>Hỗ trợ 24/7 <i class="fa fa-check fa-fw"></i></li>
                        </ul>
                        <a class="pricing-btn blue-btn" href="#"> Đăng ký </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- PRICING TABLE SECTION END -->

<!-- FAN FACT SECTION START -->
<section class="fan-fact-section section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="single-items">
                    <h2><b data-counter="counterup" data-value="1000">0</b>+</h2>
                    <img src="{{ asset('public/themes/default/images/fan-fact/fan-fact-1.png') }}" alt="fan-fact-icon">
                    <h4>Registared Domains</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="single-items">
                    <h2><b data-counter="counterup" data-value="1000">0</b>+</h2>
                    <img src="{{ asset('public/themes/default/images/fan-fact/fan-fact-2.png') }}" alt="fan-fact-icon">
                    <h4>Sites Hosted</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="single-items">
                    <h2><b data-counter="counterup" data-value="1000">0</b>+</h2>
                    <img src="{{ asset('public/themes/default/images/fan-fact/fan-fact-3.png') }}" alt="fan-fact-icon">
                    <h4>Happy Clients</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="single-items">
                    <h2><b data-counter="counterup" data-value="1000">0</b>+</h2>
                    <img src="{{ asset('public/themes/default/images/fan-fact/fan-fact-4.png') }}" alt="fan-fact-icon">
                    <h4>Awards Won</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FAN FACT SECTION END -->

@endsection