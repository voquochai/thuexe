@extends('frontend.member.master')
@section('content')
<div class="row"> @include('frontend.default.blocks.messages') </div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ __('cart.your_order') }}</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th width="10%"> Ngày đặt </th>
                        <th width="7%"> Mã đơn hàng </th>
                        <th width="7%"> Số lượng </th>
                        <th width="7%"> Tổng giá </th>
                        <th width="10%"> Tình trạng </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr id="record-{{ $item->id }}">
                        <td align="center"> {{ $item->created_at }} </td>
                        <td align="center"><a href="{{ route('frontend.member.order_detail',['id'=>$item->id]) }}">{{ $item->code }}</a></td>
                        <td align="center">{{ $item->quantity }}</td>
                        <td align="center">{{ get_currency_vn($item->total,'') }}</td>
                        <td align="center">{{ config('siteconfig.order_site_status.'.$item->status_id) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="30" align="center"> Không có bản dữ liệu trong bảng </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-center"> {{ $items->links('frontend.default.layouts.paginate') }} </div>
    </div>
</div>

@endsection