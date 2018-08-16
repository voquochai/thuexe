@extends('qlyxe.app')
@section('breadcrumb')
<li>
    <span> {{ $pageTitle }} </span>
</li>
@endsection
@section('content')
<div class="row">
	@include('qlyxe.blocks.messages')
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers"></i>Danh sách
                </div>
                <div class="actions">
                    <a href="{{ route('qlyxe.order.create',['type'=>$type]) }}" class="btn btn-sm btn-default"> Thêm mới </a>
                    <div class="btn-group">
                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Hành động (<span class="count-checkbox">0</span>)
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            @foreach($siteconfig[$type]['status'] as $key => $act)
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="{{ $key }}" data-ajax="act=update_status|table=orders|col=status|val={{ $key }}"> {{ $act }} </a>
                            </li>
                            @endforeach
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="delete" data-ajax="act=delete_record|table=orders"> Xóa dữ liệu </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="portlet-body">
				<div class="table-responsive">
					<table class="table table-bordered table-condensed">
						<thead>
							<tr>
								<th width="1%">
                                    <label class="mt-checkbox mt-checkbox-single">
                                        <input type="checkbox" name="select" class="group-checkable">
                                        <span></span>
                                    </label>
                                </th>
                                <th width="3%"> Thứ tự </th>
                                <th width="10%"> Khách hàng </th>
                                <th width="7%"> Mã đơn hàng </th>
                                <th width="7%"> Số lượng </th>
                                <th width="7%"> Tổng giá </th>
                                <th width="10%"> Ngày đặt </th>
                                <th width="10%"> Tình trạng </th>
                                <th width="10%"> Thực thi </th>
							</tr>
						</thead>
						<tbody>
                            <tr>
                                <td colspan="30" align="center">
                                    Tổng số lượng: <span class="font-red-mint font-md bold"> {{ get_currency_vn($total->qty,'') }} </span>
                                    -
                                    Tổng tiền: <span class="font-red-mint font-md bold"> {{ get_currency_vn($total->price,'') }} </span>
                                </td>
                            </tr>
                            @forelse($items as $item)
                            <tr id="record-{{ $item->id }}">
                                <td align="center">
                                    <label class="mt-checkbox mt-checkbox-single">
                                        <input type="checkbox" name="id[]" class="checkable" value="{{ $item->id }}">
                                        <span></span>
                                    </label>
                                </td>
                                <td align="center"> <input type="text" name="priority" class="form-control input-mini input-priority" value="{{ $item->priority }}" data-ajax="act=update_priority|table=orders|id={{ $item->id }}|col=priority"> </td>
                                <td align="center"><a href="{{ route('qlyxe.order.edit',['id'=>$item->id, 'type'=>$type]) }}"> {{ $item->name.' - '.$item->phone }} </a></td>
                                <td align="center">{{ $item->code }}</td>
                                <td align="center">{{ $item->order_qty }}</td>
                                <td align="center">{!! get_currency_vn($item->order_price,'') !!}</td>
                                <td align="center">{{ $item->created_at }}</td>
                                <td align="center"> <span class="label label-sm label-{{ config('siteconfig.order_thuexe_labels.'.$item->status_id) }}">{{ config('siteconfig.order_thuexe_status.'.$item->status_id) }}</span></td>
                                <td align="center">
                                    <a href="{{ route('qlyxe.order.edit',['id'=>$item->id, 'type'=>$type]) }}" class="btn btn-sm blue" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
                                    <form action="{{ route('qlyxe.order.delete',['id'=>$item->id, 'type'=>$type]) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-sm btn-delete red" title="Xóa"> <i class="fa fa-times"></i> </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="30" align="center"> Không có bản dữ liệu trong bảng </td>
                            </tr>
                            @endforelse
						</tbody>
					</table>
				</div>
				<div class="text-center"> {{ $items->appends(['type'=>$type])->links() }} </div>
			</div>
		</div>
	</div>
</div>
@endsection