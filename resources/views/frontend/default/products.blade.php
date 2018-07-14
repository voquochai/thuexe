@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-xs-12 pull-right">
                <div class="row display-flex">
                    @forelse($products as $product)
                        {!! get_template_product($product,$type,3,'mb-30') !!}
                    @empty
                    <div class="col-xs-12"><p> Sản phẩm chưa cập nhật </p></div>
                    @endforelse
                </div>
                @if( count($products) > 0 )
                <div class="page-pagination text-center">
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