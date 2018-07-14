@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row mb-30">
            <div class="col-xs-12 mb-30">
                <div class="product-detail">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 col-xs-wide mb-30">
                            <div class="image">
                                <div class="slick-product-image">
                                    <div>
                                        <img src="{{ ( $product->image && file_exists(public_path('/uploads/products/'.$product->image)) ? asset( 'public/uploads/products/'.$product->image ) : asset('noimage/500x625') ) }}" alt="{{ $product->alt }}" />
                                    </div>
                                    @forelse($images as $image)
                                    <div>
                                        <img src="{{ ( $image->image && file_exists(public_path('/uploads/products/'.$image->image)) ? asset( 'public/uploads/products/'.$image->image ) : asset('noimage/500x625') ) }}" alt="{{ $image->alt }}" />
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="slick-product-thumb">
                                    <div>
                                        <div class="pd-10">
                                            <a href="javascript:;"><img src="{{ ( $product->image && file_exists(public_path('/uploads/products/'.$product->image)) ? asset('thumbnail/100x100x2/uploads/products/'.$product->image) : asset('noimage/100x100') ) }}" alt="{{ $product->alt }}" /></a>
                                        </div>
                                    </div>
                                    @forelse($images as $image)
                                    <div>
                                        <div class="pd-10">
                                            <a href="javascript:;"><img src="{{ ( $image->image && file_exists(public_path('/uploads/products/'.$image->image)) ? asset('thumbnail/100x100x2/uploads/products/'.$image->image) : asset('noimage/100x100') ) }}" alt="{{ $image->alt }}" /></a>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12 mb-30">
                            <div class="info">
                                <h1 class="title">{{ $product->title }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        {!! $product->contents !!}
                    </div>
                    <!-- Comments Wrapper -->
                    @include('frontend.default.blocks.comment')
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 mb-40">
                <div class="sidebar" id="app-cart">
                    <div class="sidebar-widget mb-40">
                        <div class="product-attributes">
                            <ul>
                            @forelse($attributes as $attribute)
                                @if( $attribute['name'] !== null && $attribute['value'] !== null )
                                <li> {!! $attribute['name'].$attribute['value'] !!} </li>
                                @endif
                            @empty
                            @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget mb-40">
                        <div class="product-price">
                            <div class="float-left"><label>{{ __('site.product_price') }}</label></div>
                            <div class="float-right">{!! get_template_product_price($product->regular_price,$product->sale_price) !!}</div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
    
<!-- PRODUCT SECTION START -->
<section class="page-section pb-60">
    <div class="container">
        <div class="row">
            <div class="section-title text-center col-xs-12 mb-70">
                <h2>{{ __('site.product_other') }}</h2>
            </div>
        </div>
        <div class="row display-flex">
            @forelse($products as $item)
                {!! get_template_product($item,$type,3) !!}
            @empty
            @endforelse
        </div>
    </div>
</section>
<!-- PRODUCT SECTION END --> 
@endsection