@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section pt-60 pb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-xs-12 pull-right">
                <div class="row display-flex display-list">
                    @forelse($products as $product)
                        {!! get_template_product($product,$type,1) !!}
                    @empty
                    <div class="col-xs-12"><p> Sản phẩm chưa cập nhật </p></div>
                    @endforelse
                </div>
                @if( count($products) > 0 )
                <div class="page-pagination text-center col-xs-12 fix mb-40">
                	{{ $products->links('frontend.default.blocks.paginate') }}
                </div>
                @endif
            </div>
            <div class="col-lg-3 col-md-4 col-xs-12">
                @include('frontend.default.layouts.sidebar')
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
@endsection