@php $slideshow = get_photos('slideshow',$lang); @endphp
<!-- START SLIDER SECTION -->
<section class="slider-section section">
	<div id="home-slider" class="slides">
		@forelse($slideshow as $slide)
		<img src="{{ asset('public/uploads/photos/'.$slide->image) }}" alt="" title="#slider-caption-0"  />
		@empty
		@endforelse
	</div>
	{{--
	<div id="slider-caption-0" class="nivo-html-caption">
		<div class="container">
			<div class="row">
				<div class="hero-slider-content col-md-6 col-md-offset-6 col-sm-7 col-sm-offset-5 col-xs-12">
					<h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">welcome to our</h4>
					<h1 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">furniture gallery</h1>
					<p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
					<a href="/collections/all" class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">Buy Now</a>
				</div>
			</div>
		</div>
	</div>
	<div id="slider-caption-1" class="nivo-html-caption">
		<div class="container">
			<div class="row">
				<div class="hero-slider-content col-md-6 col-md-offset-6 col-sm-7 col-sm-offset-5 col-xs-12">
					<h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">welcome to our</h4>
					<h1 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">furniture gallery</h1>
					<p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
					<a href="/collections/all" class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">Buy Now</a>
				</div>
			</div>
		</div>
	</div>
	--}}
</section>
<!-- END SLIDER SECTION -->