@extends('frontend.member.master')
@section('content')
<div class="row"> @include('frontend.default.blocks.messages') </div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ __('account.profile') }}</h3>
    </div>
    <div class="panel-body">
    	
    	<form role="form" method="POST" action="{{ route('frontend.member.profile') }}" >
    		{{ csrf_field() }}
        	{{ method_field('put') }}

        	<div class="form-group">
                <label class="control-label">Email</label>
                <div>
                    <input type="text" class="form-control" value="{{ $member->email }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Tên đăng nhập</label>
                <div>
                    <input type="text" class="form-control" value="{{ $member->username }}" disabled>
                </div>
            </div>

        	<div class="form-group">
                <label class="control-label">Họ và tên</label>
                <div>
                    <input type="text" name="data[name]" class="form-control" value="{{ $member->name }}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label">Điện thoại</label>
                <div>
                    <input type="text" name="data[phone]" class="form-control" value="{{ $member->phone }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Địa chỉ</label>
                <div>
                    <input type="text" name="data[address]" class="form-control" value="{{ $member->address }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Mật khẩu cũ</label>
                <div>
                    <input type="password" name="oldpassword" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Mật khẩu mới</label>
                <div>
                    <input type="password" name="password" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Xác nhận mật khẩu mới</label>
                <div>
                    <input type="password" name="password_confirmation" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn"> Cập nhật </button>
            </div>

    	</form>
    </div>
</div>

@endsection