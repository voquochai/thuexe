@extends('admin.app')
@section('breadcrumb')
<li>
    <span> {{ $pageTitle }} </span>
</li>
@endsection
@section('content')
<div class="row">
	@include('admin.blocks.messages')
	<div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet">
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> Bình luận </div>
                </div>
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-circle green btn-sm btn-comment-approved">Tất cả</button>
                    <button type="button" class="btn btn-circle default btn-sm btn-comment-unapproved">Chưa duyệt</button>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav nav-list-item-comment">
                        @forelse($items as $item)
                        <li>
                            <a href="#comment-{{ $item->product_id }}" data-ajax="table=products|id={{ $item->product_id }}">{{ $item->title }} <span class="badge badge-success">{{ $item->sum }}</span></a>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-green"></i>
                        <span class="caption-subject bold font-green uppercase"> Bình luận</span>
                    </div>
                    <div class="actions">
                        <a href="#" id="btn-comment-delete-all" class="btn btn-sm btn-circle red"> <i class="icon-trash"></i> Xóa tất cả </a>
                    </div>
                </div>
                <div class="portlet-body" id="portlet-load-ajax">Không có dữ liệu trong bảng</div>
            </div>
        </div>
    </div>
</div>
@endsection