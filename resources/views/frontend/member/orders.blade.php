@extends('frontend.member.master')
@section('content')
<div class="row">
    @include('frontend.default.blocks.messages')
    <div class="col-xs-12">
        <div class="cart-table table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="7%"> Mã đơn hàng </th>
                        <th width="10%"> Ngày đặt </th>
                        <th width="7%"> Số lượng </th>
                        <th width="7%"> Tổng giá </th>
                        <th width="10%"> Tình trạng </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr id="record-{{ $item->id }}">
                        <td align="center"><a href="{{ route('frontend.member.order_detail',['id'=>$item->id]) }}"><b>{{ $item->code }}</b></a></td>
                        <td align="center"> {{ $item->created_at }} </td>
                        <td align="center">{{ $item->order_qty }}</td>
                        <td align="center">{{ get_currency_vn($item->order_price,'') }}</td>
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
        <div class="text-center"> {{ $items->links('frontend.default.blocks.paginate') }} </div>
    </div>
</div>
@endsection