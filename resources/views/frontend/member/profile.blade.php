@extends('frontend.member.master')
@section('content')
<div class="row"> @include('frontend.default.blocks.messages') </div>
<div class="panel panel-default panel-profile">
    <div class="panel-heading">
        <h3 class="panel-title">{{ __('account.profile') }}</h3>
    </div>
    <div class="panel-body">
    	
    	<form role="form" method="POST" action="{{ route('frontend.member.profile') }}" >
    		{{ csrf_field() }}
        	{{ method_field('put') }}

        	<div class="form-group row">
                <label class="control-label col-md-3">Email</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" value="{{ $member->email }}" disabled>
                </div>
            </div>

        	<div class="form-group row">
                <label class="control-label col-md-3">Họ và tên</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="data[name]" class="form-control" value="{{ $member->name }}">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="control-label col-md-3">Điện thoại</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="data[phone]" class="form-control" value="{{ $member->phone }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3">Địa chỉ</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="data[address]" class="form-control" value="{{ $member->address }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-md-3">Mật khẩu cũ</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="password" name="oldpassword" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3">Mật khẩu mới</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="password" name="password" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3">Xác nhận mật khẩu mới</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="password" name="password_confirmation" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9 col-sm-12 col-xs-12 pull-right">
                    <button type="submit" class="btn btn-site"> Cập nhật </button>
                </div>
            </div>

    	</form>
    </div>
</div>

@endsection