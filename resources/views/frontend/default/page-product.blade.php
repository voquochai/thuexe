@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row mb-30">
            <div class="col-xs-12 mb-30">
                <div class="product-details">
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
                                <ul>
                                    <li><h1 class="title">{{ $product->title }}</h1></li>
                                    <li><label>{{ __('site.product_price') }}:</label><span class="price">{!! get_template_product_price($product->regular_price,$product->sale_price) !!}</span></li>

                                    @forelse($attributes as $attribute)
                                        @if( $attribute['name'] !== null && $attribute['value'] !== null )
                                        <li><label>{!! $attribute['name'] !!}</label>: {!! $attribute['value'] !!} </li>
                                        @endif
                                    @empty
                                    @endforelse

                                    @if($product->description)
                                    <li>{{ $product->description }}</li>
                                    @endif

                                    <li>
                                        <label>{{ __('site.product_color') }}:</label>
                                        <div class="color-list">
                                            @forelse($colors as $key => $color)
                                            <button {!! ($key == 0) ? 'class="active"' : '' !!} style="background-color: {{ $color->value }};" data-id="{{ $color->id }}" ><i class="fa fa-check"></i></button>
                                            @empty
                                            @endforelse
                                        </div>
                                    </li>
                                    <li>
                                        <label>{{ __('site.product_size') }}:</label>
                                        <div class="size-list">
                                            @forelse($sizes as $key => $size)
                                            <button {!! ($key == 0) ? 'class="active"' : '' !!} data-id="{{ $size->id }}" ><i class="fa fa-check"></i> {{ $size->title }} </button>
                                            @empty
                                            @endforelse
                                        </div>
                                    </li>

                                    <li>
                                        <label>{{ __('cart.quantity') }}:</label>
                                        <div class="quantity">
                                            <input type="text" name="quantity" value="1">
                                        </div>
                                        <a href="#" id="add-to-cart" class="btn btn-site uppercase" data-ajax="id={{ $product->id }}"> Thêm giỏ hàng </a>
                                    </li>

                                    <li>
                                        <label>Share:</label>
                                        <div class="share-icons">
                                            <a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fa fa-facebook"></i>  facebook</a>
                                            <a target="_blank" class="twitter" href="https://twitter.com/home?status={{ url()->current() }}"><i class="fa fa-twitter"></i>  twitter</a>
                                            <a target="_blank" class="google" href="https://plus.google.com/share?url={{ url()->current() }}"><i class="fa fa-google-plus"></i>  google</a>
                                            <a target="_blank" class="pinterest" href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}&media={{ asset('public/uploads/products/'.$product->image) }}&description={{ $product->description }}"><i class="fa fa-pinterest"></i>  pinterest</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        {!! $product->contents !!}
                    </div>
                </div>
                <!-- Comments Wrapper -->
                @include('frontend.default.blocks.comment')
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 mb-40">
                <div class="sidebar" id="app-cart">
                    <div class="sidebar-widget mb-40">
                        <div class="product-attributes">
                            <ul>
                            
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget mb-40">
                        <div class="product-price">
                            <div class="float-left"><label></label></div>
                            <div class="float-right"></div>
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