@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            @include('frontend.default.blocks.messages')
            <div class="checkout-form">
                <form method="post" action="{{ url('/thanh-toan') }}">
                    {{ csrf_field() }}
                    <div class="col-lg-6 col-md-6 mb-40">
                        <h3> {{ __('cart.billing_details') }} </h3>
                        <div class="row">
                            <div class="col-xs-12 mb-15">
                                <label for="name">{{ __('cart.name') }} <span class="required">*</span></label>                                        
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label for="address">{{ __('cart.address') }} <span class="required">*</span></label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}" />
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label for="email">Email<span class="required">*</span></label>                                      
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                            </div>
                            <div class="col-xs-12 mb-15">
                                <label for="phone">{{ __('cart.phone') }}  <span class="required">*</span></label>                                     
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" />
                            </div>
                            <div class="col-sm-6 col-xs-12 mb-15">
                                <label for="province">{{ __('cart.province') }} <span class="required">*</span></label>
                                <select class="province form-control" name="province_id">
                                    <option value="{{ old('province_id') }}" selected ></option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-12 mb-15">
                                <label for="district">{{ __('cart.district') }} <span class="required">*</span></label>
                                <select class="district form-control" name="district_id">
                                    <option value="{{ old('district_id') }}" selected ></option>
                                </select>
                            </div>
                        </div>
                        <div class="order-notes">
                            <label for="order_note">{{ __('cart.notes') }}</label>
                            <textarea name="order_note" class="form-control">{{ old('order_note') }}</textarea>                           
                        </div>
                                                             
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 mb-40">
                        <div class="coupon-form mb-30">
                            <div class="cart-coupon">
                                <h3> Coupon </h3>
                                <p> {{ __('cart.enter_coupon') }} </p>
                                <input type="text" class="form-control" placeholder="{{ __('cart.coupon_code') }}" value="{{ @$coupon['code'] }}" />
                                <button type="button" >{{ __('cart.use') }}</button>
                            </div>
                            <div id="result-coupon">
                                @if( $coupon )
                                <div class="alert alert-{{ $coupon['effective']['type'] }} no-margin">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <i class="fa-lg fa fa-{{ $coupon['effective']['icon'] }}"></i> {!! $coupon['effective']['message'] !!}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="order-wrapper">
                            <h3> {{ __('cart.your_order') }} </h3>
                            <div class="order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name">{{ __('cart.product_name') }}</th>
                                            <th class="product-total">{{ __('cart.total') }} (Đ)</th>
                                        </tr>                           
                                    </thead>
                                    <tbody>
                                        @forelse($cart as $key => $val)
                                            <tr class="pro-key-{{ $key }}">
                                                <td class="product-name">
                                                    {{ $val['title'].($val['color_title'] ? ' - '.$val['color_title'] : '').($val['size_title'] ? ' - '.$val['size_title'] : '') }} <strong class="product-qty"> × {{ $val['qty'] }} </strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ get_currency_vn($val['price']*$val['qty'],'') }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr> <td colspan="10"> {{ __('cart.no_item') }} </td> </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('cart.cart_total') }}</th>
                                            <td><span class="sumCartPrice"></span></td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('cart.order_total') }}</th>
                                            <td><strong class="sumOrderPrice"></strong>
                                            </td>
                                        </tr>                               
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="panel-group" id="accordion">
                                    @forelse($payments as $key => $payment)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label data-toggle="collapse" data-parent="#accordion" data-target="#collapse-{{ $key }}"><input type="radio" name="payment" value="{{ $payment->title }}" {{ $key==0 ? 'checked' : '' }} > {{ $payment->title }}</label>
                                            </h4>
                                        </div>
                                        <div id="collapse-{{ $key }}" class="panel-collapse collapse {{ $key==0 ? 'in' : '' }}">
                                            <div class="panel-body">
                                                <p> {{ $payment->description }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="order-button">
                            <center> <button type="submit" class="btn btn-site">{{ __('cart.place_order') }}</button> </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END --> 
@endsection