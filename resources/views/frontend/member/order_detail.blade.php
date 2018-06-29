@extends('frontend.member.master')
@section('content')
<!-- PAGE SECTION START -->
<div class="page-section section">
    <div class="container">
        <div class="row">
            @if ( $item !== null )
            <div class="col-md-12 mb-40 mt-element-step">
                <div class="row step-thin">
                    @forelse( config('siteconfig.order_site_status') as $key => $val )
                    <div class="col-lg-3 col-md-6 bg-grey mt-step-col {{ $item->status_id == $key ? 'active' : '' }} ">
                        <div class="mt-step-number bg-white font-grey">{{ $key }}</div>
                        <div class="mt-step-title uppercase font-grey-cascade">{{ $val }}</div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12 mb-40">
                        <h3 class="mb-15 uppercase"> {{ __('cart.billing_details') }} </h3>
                        <div class="row">
                            <div class="col-xs-12 mb-15">
                                <label>{{ __('cart.name') }}:</label> {{ $item->name }}
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label>{{ __('cart.address') }}:</label> {{ $item->address }}
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label>Emai</label> {{ $item->email }}
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label>{{ __('cart.phone') }}:</label> {{ $item->phone }}
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label>{{ __('cart.province') }}:</label> <span class="simple-province" data-key="{{ $item->province_id }}"></span>
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label>{{ __('cart.district') }}:</label> <span class="simple-district" data-key="{{ $item->district_id }}"></span>
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label>{{ __('cart.notes') }}:</label> {{ $item->note }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 mb-40">
                        @if( $item->coupon_code )
                        <h3 class="mb-15 uppercase"> Coupon </h3>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <i class="fa-lg fa fa-check"></i> {{ __('cart.sale',['attribute'=>get_currency_vn($item->coupon_amount)]) }}
                        </div>
                        @endif
                        <h3 class="mb-15 uppercase"> {{ __('cart.your_order') }} </h3>
                        <div class="order-table table-responsive mb-30">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-name">{{ __('cart.product_name') }}</th>
                                        <th class="product-total">{{ __('cart.total') }} (Đ)</th>
                                    </tr>                           
                                </thead>
                                <tbody>
                                    @forelse($products as $key => $val)
                                        <tr>
                                            <td class="product-name">
                                                {{ $val['pname'].($val['pcolor'] ? ' - '.$val['pcolor'] : '').($val['psize'] ? ' - '.$val['psize'] : '') }} <strong class="product-qty"> × {{ $val['qty'] }} </strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount">{{ get_currency_vn($val['sumProPrice'],'') }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr> <td colspan="10"> {{ __('cart.no_item') }} </td> </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>{{ __('cart.cart_total') }}</th>
                                        <td><span class="sumCartPrice">{{ get_currency_vn($item->subtotal,'') }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('cart.order_total') }}</th>
                                        <td><strong class="sumOrderPrice">{{ get_currency_vn($item->total,'') }}</strong>
                                        </td>
                                    </tr>                               
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            @else
            <div class="col-md-12" id="alert-container">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p> {{ __('site.no_data') }} </p>
                </div>
            </div>
            @endif
            
        </div>
    </div>
</div>
<!-- PAGE SECTION END --> 
@endsection