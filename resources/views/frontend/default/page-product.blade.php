@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="product-details">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 col-xs-wide mb-30">
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
                                    <li><span class="price">{!! get_template_product_price($product->regular_price,$product->sale_price) !!}</span></li>

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
                                        <div class="product-quantity">
                                            <input type="text" name="quantity" value="1">
                                        </div>
                                        <a href="#" id="add-to-cart" class="btn btn-site uppercase" data-ajax="id={{ $product->id }}"> Thêm giỏ hàng </a>
                                    </li>

                                    <li>
                                        <label>Share:</label>
                                        <div class="share-icons">
                                            <a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fa fa-facebook"></i> facebook</a>
                                            <a target="_blank" class="twitter" href="https://twitter.com/home?status={{ url()->current() }}"><i class="fa fa-twitter"></i> twitter</a>
                                            <a target="_blank" class="google" href="https://plus.google.com/share?url={{ url()->current() }}"><i class="fa fa-google-plus"></i> google</a>
                                            <a target="_blank" class="pinterest" href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}&media={{ asset('public/uploads/products/'.$product->image) }}&description={{ $product->description }}"><i class="fa fa-pinterest"></i> pinterest</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-contents">
                    {!! $product->contents !!}
                </div>
                <!-- Comments Wrapper -->
                @include('frontend.default.blocks.comment')
            </div>
        </div>
        <div class="row">
            <div class="section-title text-center">
                <h2>{{ __('site.product_other') }}</h2>
            </div>
            <div class="slick-product-other">
                
                @forelse($products as $item)
                <div>
                    {!! get_template_product($item,$type,1) !!}
                </div>
                @empty
                @endforelse
                
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
@endsection