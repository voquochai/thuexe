@extends('frontend.default.master')
@section('content')
<!-- PRODUCT SECTION START -->
<section class="product-section pt-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row display-flex">
            @forelse($new_products as $key => $val)
            	@if($key == 1)
            	<div class="col-md-4 col-sm-6 col-xs-12">
            		<div class="single-post">
	            		<h2 class="title"> Sản phẩm <span>mới</span> </h2>
	            		<p class="desc">{{ $single_post->description }}</p>
	            		<p class="image"><img src="{{ ( $single_post->image && file_exists(public_path('/uploads/pages/'.$single_post->image)) ? asset( 'public/uploads/pages/'.get_thumbnail($single_post->image, '_small') ) : asset('noimage/370x230') ) }}"></p>
            		</div>
            	</div>
            	@endif
            	{!! get_template_product($val,'san-pham',3) !!}
            @empty
            @endforelse
        </div>
    </div>
</section>
<!-- PRODUCT SECTION END -->

<section class="collection-section pt-40 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="section-title"> <h2>Bộ <span>sưu tập</span> </h2> </div>
    </div>
</section>

@endsection