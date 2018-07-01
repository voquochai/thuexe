@extends('frontend.default.master')
@section('content')
<!-- PRODUCT SECTION START -->
<section class="product-section ptb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row display-flex">
            @forelse($new_products as $val)
                {!! get_template_product($val,'san-pham',3) !!}
            @empty
            @endforelse
        </div>
    </div>
</section>
<!-- PRODUCT SECTION END -->
@endsection