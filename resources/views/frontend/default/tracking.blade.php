@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section pt-60 pb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row">
            @if ( $item !== null )
            <div class="col-lg-9 col-md-8 col-xs-12 pull-right">
                @if( $item->status_id == 1 )
                <div class="alert alert-success" role="alert">
                    <p>Đăng ký hoàn tất! Vui lòng chuyển khoản theo cú pháp dưới đây:</p>
                    <p>
                        <b>Chủ tài khoản:</b> Võ Quốc Hải<br/>
                        <b>Số tài khoản:</b> 0441000721604<br/>
                        <b>Ngân hàng:</b> Vietcombank - Chi nhánh Tân Bình - TP. HCM<br/>
                        <b>Nội dung:</b> Thanh toán hợp đồng #{{ $item->code }}
                    </p>
                </div>
                @endif
                <div class="pb-20">
                    <p class="text-right font-sm">Hợp đồng #{{ $item->code }} được tạo ngày {{ date('d/m/Y', strtotime($item->created_at) ) }} </p>
                    <p class="text-right"><button class="btn btn-lg btn-{{config('siteconfig.order_site_labels.'.$item->status_id)}}"> {{ config('siteconfig.order_site_status.'.$item->status_id) }} </button></p>
                </div>
                <div class="alert alert-info mb-40">
                    <h4 class="text-center uppercase bold pt-10">Thông tin hợp đồng</h4>
                </div>
                <div>
                    <p> <b> Kính gửi (Ông/Bà):</b> {{ $item->name }}</p>
                    <p> Chúng tôi xin chân thành cảm ơn Quý khách đã tín nhiệm sử dụng dịch vụ của {{ config('app.name') }}. Dưới đây là thông tin các dịch vụ Quý khách đã đăng ký.</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="active">
                                <th width="15%"> Số hợp đồng </th>
                                <th width="20%"> Ngày tạo </th>
                                <th width="20%"> Ngày thanh toán </th>
                                <th width="25%"> Hình thức thanh toán </th>
                                <th width="20%"> Tổng tiền </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"> {{ $item->code }} </td>
                                <td align="center"> {{ date('d/m/Y', strtotime($item->created_at) ) }} </td>
                                <td align="center"> {{ date('d/m/Y', strtotime($item->created_at)+($item->order_qty*31556926) ) }} </td>
                                <td align="center"> {{ config('siteconfig.payment_method.3') }} </td>
                                <td align="center"> {{ get_currency_vn($item->order_price) }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pt-60 pb-20">
                    <h4 class="uppercase font-red bold">Dịch vụ đăng ký trong hợp đồng</h4>
                </div>
                @php
                    $hosting = $domain = '';
                    if($product->size_title !== null){
                        $domain = explode(' - ',$product->size_title);
                    }
                    if($product->color_title !== null){
                        $hosting = explode(' - ',$product->color_title);
                    }
                @endphp
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="active">
                                <th width="5%"> Stt </th>
                                <th> Chi tiết dịch vụ </th>
                                <th width="20%"> Thành tiền </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"> 1 </td>
                                <td> <span class="bold underline">Website:</span> {{ $product->product_title }} </td>
                                <td align="center"> {{ get_currency_vn($product->product_price) }} </td>
                            </tr>
                            @if($domain)
                            <tr>
                                <td align="center"> 2 </td>
                                <td> <span class="bold underline">Domain:</span> {{ $domain[0] }} </td>
                                <td align="center"> {{ $domain[1] }} đ </td>
                            </tr>
                            @endif

                            @if($hosting)
                            <tr>
                                <td align="center"> {{ $domain ? 3 : 2 }} </td>
                                <td> <span class="bold underline">Hosting:</span> {{ $hosting[0] }} </td>
                                <td align="center"> {{ $hosting[1] }} đ </td>
                            </tr>
                            @endif
                            <tr class="active">
                                <td align="right" colspan="2"> Tổng tiền </td>
                                <td align="center"> <b class="bold font-red font-lg">{{ get_currency_vn($item->order_price) }}</b> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-12">
                <div class="sidebar">
                    <div class="sidebar-widget mb-20">
                        <h4 class="title">Đơn hàng của bạn</h4>
                        <ul class="category">
                            <li> <a href="#" class="active"> {{ $item->code }} </a> </li>
                        </ul>
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
</section>
<!-- PAGE SECTION END --> 
@endsection