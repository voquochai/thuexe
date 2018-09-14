@extends('admin.app')
@section('breadcrumb')
<li>
    <a href="{{ route('admin.attribute.index', ['type'=>$type]) }}"> {{ $pageTitle }} </a>
    <i class="fa fa-circle"></i>
</li>
<li>
    <span>Chỉnh sửa</span>
</li>
@endsection
@section('content')
<div class="row">
    @include('admin.blocks.messages')
    <!-- BEGIN FORM-->
    <form role="form" method="POST" action="{{ route('admin.attribute.update',['id'=>$item->id,'type'=>$type]) }}" enctype="multipart/form-data" >
        {{ csrf_field() }}
        {{ method_field('put') }}
        <input type="hidden" name="redirects_to" value="{{ (old('redirects_to')) ? old('redirects_to') : url()->previous() }}" />
        <div class="col-lg-9 col-xs-12"> 
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"> Chỉnh sửa </div>
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
                        @php $i=0; @endphp
                        @foreach($languages as $key => $lang)
                        <div class="tab-pane {!! (( $key==$default_language ) ? 'active' : '') !!}" id="tab_{{ $key }}">
                            <div class="form-group">
                                <label for="name" class="control-label">Tên</label>
                                <div>
                                    <input type="text" class="form-control {!! (( $key==$default_language )?'title':'') !!}" name="dataL[{{ $key }}][title]" value="{{ isset( $item->languages[$i] ) ? $item->languages[$i]['title'] : '' }}">
                                </div>
                            </div>

                        </div>
                        @php $i++ @endphp
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
                        <div class="input-group colorpicker-component" data-color="{{ $item->value ? $item->value : '#ffffff' }}">
                            <input type="text" name="data[value]" value="{{ $item->value }}" class="form-control"/>
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    @endif

                    @if($siteconfig[$type]['price'])
                    <div class="form-group">
                        <label class="control-label">Giá bán</label>
                        <div class="input-group">
                            <input type="text" name="regular_price" class="form-control priceFormat" value="{{ $item->regular_price }}" />
                            <span class="input-group-addon">Đ</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Giá khuyến mãi</label>
                        <div class="input-group">
                            <input type="text" name="sale_price" class="form-control priceFormat" value="{{ $item->sale_price }}" />
                            <span class="input-group-addon">Đ</span>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="control-label">Tình trạng</label>
                        <div>
                            <select class="selectpicker show-tick show-menu-arrow form-control" name="status[]" multiple>
                                <optgroup >
                                    @foreach($siteconfig[$type]['status'] as $key => $val)
                                    <option value="{{ $key }}" {{ (strpos($item->status,$key) !== false)?'selected':'' }} > {{ $val }} </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Thứ tự</label>
                        <div>
                            <input type="text" name="priority" value="{{ $item->priority }}" class="form-control priceFormat">
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