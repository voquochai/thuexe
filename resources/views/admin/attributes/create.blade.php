@extends('admin.app')
@section('breadcrumb')
<li>
    <a href="{{ route('admin.attribute.index', ['type'=>$type]) }}"> {{ $pageTitle }} </a>
    <i class="fa fa-circle"></i>
</li>
<li>
    <span> Thêm mới</span>
</li>
@endsection
@section('content')
<div class="row">
    @include('admin.blocks.messages')
    <!-- BEGIN FORM-->
    <form role="form" method="POST" action="{{ route('admin.attribute.store',['type'=>$type]) }}" enctype="multipart/form-data" >
        {{ csrf_field() }}
        <div class="col-lg-9 col-xs-12"> 
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"> Thêm mới </div>
                    <ul class="nav nav-tabs">
                        @foreach($languages as $key => $lang)
                        <li {!! (( $key==$default_language )?'class="active"':'') !!}>
                            <a href="#tab_{{ $key }}" data-toggle="tab" aria-expanded="false"> {{ $lang }} </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        @foreach($languages as $key => $lang)
                        <div class="tab-pane {!! (( $key==$default_language )?'active':'') !!}" id="tab_{{ $key }}">
                            <div class="form-group">
                                <label for="name" class="control-label">Tên</label>
                                <div>
                                    <input type="text" class="form-control {!! (( $key==$default_language )?'title':'') !!}" name="dataL[{{ $key }}][title]" value="{{ old('dataL.'.$key.'.title') }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">Thông tin chung </div>
                </div>
                <div class="portlet-body">
                    @if($siteconfig[$type]['colorpicker'])
                    <div class="form-group">
                        <label class="control-label">Mã màu</label>
                        <div class="input-group colorpicker-component" data-color="{{ (old('data.value')) ? old('data.value') : '#ffffff' }}">
                            <input type="text" name="data[value]" value="{{ (old('data.value')) ? old('data.value') : '' }}" class="form-control"/>
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    @endif
                    @if($siteconfig[$type]['price'])
                    <div class="form-group">
                        <label class="control-label">Giá bán </label>
                        <div class="input-group">
                            <input type="text" name="regular_price" class="form-control priceFormat" value="{{ (old('regular_price')) ? old('regular_price') : '' }}" />
                            <span class="input-group-addon"> Đ </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Giá khuyến mãi</label>
                        <div class="input-group">
                            <input type="text" name="sale_price" class="form-control priceFormat" value="{{ (old('sale_price')) ? old('sale_price') : '' }}" />
                            <span class="input-group-addon"> Đ </span>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label">Tình trạng</label>
                        <div>
                            <select class="selectpicker show-tick show-menu-arrow form-control" name="status[]" multiple>
                                @foreach($siteconfig[$type]['status'] as $key => $val)
                                <option value="{{ $key }}" {{ ($key=='publish')?'selected':'' }} > {{ $val }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Thứ tự</label>
                        <div>
                            <input type="text" name="priority" class="form-control priceFormat" value="{{ (old('priority')) ? old('priority') : 1 }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn green"> <i class="fa fa-check"></i> Lưu</button>
                        <a href="{{ url()->previous() }}" class="btn default" > Thoát </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection