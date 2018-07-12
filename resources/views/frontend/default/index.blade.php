@extends('frontend.default.master')
@section('content')
<!-- PRODUCT SECTION START -->
<section class="product-section pt-60" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row display-flex">
            @forelse($new_products as $key => $val)
            	@if($key == 1 && $single_post)
            	<div class="col-md-4 col-sm-6 col-xs-6 col-xs-wide mb-30">
            		<div class="single-post">
	            		<h2 class="title"> Sản phẩm <span>mới</span> </h2>
	            		<p class="desc">{{ $single_post->description }}</p>
	            		<p class="image"><img src="{{ ( $single_post->image && file_exists(public_path('/uploads/pages/'.$single_post->image)) ? asset( 'public/uploads/pages/'.get_thumbnail($single_post->image, '_small') ) : asset('noimage/370x230') ) }}"></p>
            		</div>
            	</div>
            	@endif
            	{!! get_template_product($val,'san-pham',3,'mb-30') !!}
            @empty
            @endforelse
        </div>
    </div>
</section>
<!-- PRODUCT SECTION END -->

<section class="collection-section pt-40" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="section-title"> <h2>Bộ <span>sưu tập</span> </h2> </div>
    </div>
    <div class="collection-wrap">
        @forelse($collections as $key => $val)
            {!! get_template_collection($val,'bo-suu-tap',4) !!}
        @empty
        @endforelse
    </div>
</section>

<section class="banner-section pt-60" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="section-title pb-40 text-center"> <h2>Banner</h2> </div>
        <div class="banner-wrap display-flex">
            @forelse($banners as $key => $banner)
            <div class="banner-item col-xs-6 col-xs-wide">
                <img src="{{ asset('public/uploads/photos/'.$banner->image) }}" alt="{{ $banner->alt }}" />
                <h3 class="title">{{ $banner->title }}</h3>
                <span class="label {{ ($key+1)%2 == 0 ? 'label-left' : 'label-right' }}">{{ $banner->alt }}</span>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</section>

<section class="post-section ptb-60" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="section-title"> <h2>Tin tức <span>mới</span> </h2> </div>
        <div class="row">
            <div class="slick-post">
                @forelse($new_posts as $key => $val)
                    <div>
                    {!! get_template_post($val,'tin-tuc',1) !!}
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection