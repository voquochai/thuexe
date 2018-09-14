@php $slideshow = get_photos('slideshow',$lang); @endphp
<!-- START SLIDER SECTION -->
<section class="slider-section">
	<div id="home-slider" class="slides">
		@forelse($slideshow as $key => $slide)
		<img src="{{ asset('public/uploads/photos/'.$slide->image) }}" alt="{{ $slide->alt }}" title="#slider-caption-{{ $key }}"  />
		@empty
		@endforelse
	</div>
	@forelse($slideshow as $key => $slide)
	<div id="slider-caption-{{ $key }}" class="nivo-html-caption">
		<div class="container">
			<div class="row">
				<div class="hero-slider-content col-xs-12">
					<h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">{{ $slide->title }}</h2>
					<p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">{{ $slide->description }}</p>
					@if($slide->link)
					<a href="{{ $slide->link }}" class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s"> View </a>
					@endif
				</div>
			</div>
		</div>
	</div>
	@empty
	@endforelse
	
</section>
<!-- END SLIDER SECTION -->