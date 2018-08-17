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
        <div class="portlet">
            <div class="portlet-body">
                <form role="form" method="GET" id="form-search" class="form-inline text-right" action="{{ route('qlyxe.product.index') }}" >
                    <input type="hidden" name="type" value="{{ $type }}">
                    @if($siteconfig[$type]['category'])
                    <div class="form-group">
                        <select name="category_id" class="selectpicker show-tick show-menu-arrow form-control input-medium" title="Danh mục">
                            @php
                                Menu::setMenu($categories);
                                echo Menu::getMenuSelect(0,0,'',@$oldInput['category_id']);
                            @endphp
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <input type="text" name="title" class="form-control input-medium" value="{{ @$oldInput['title'] }}" placeholder="Tên hoặc Mã sản phẩm">
                    </div>
                    <div class="form-group">
                        <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control input-medium" readonly="" name="created_at" value="{{ @$oldInput['created_at'] }}" placeholder="Ngày tạo">
                            <span class="input-group-btn">
                                <button class="btn btn-sm default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="selectpicker show-tick show-menu-arrow form-control input-medium" name="status" title="Tình trạng">
                            @foreach($siteconfig[$type]['status'] as $key => $val)
                            <option value="{{ $key }}" {{ (@$oldInput['status'] == $key) ? 'selected' : '' }} > {{ $val }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('qlyxe.product.index',['type'=>$type]) }}" class="btn default"> <i class="fa fa-refresh"></i> Đặt lại</a>
                        <button type="submit" class="btn green"> <i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
		<div class="portlet box green">
			<div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers"></i>Danh sách
                </div>
                <div class="actions">
                    <a href="#" data-target="#quickly-modal" data-toggle="modal" class="btn btn-sm btn-default"> Thêm nhanh </a>
                    <a href="{{ route('qlyxe.product.create',['type'=>$type]) }}" class="btn btn-sm btn-default"> Thêm mới </a>
                    <div class="btn-group">
                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Hành động (<span class="count-checkbox">0</span>)
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            @foreach($siteconfig[$type]['status'] as $key => $act)
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="{{ $key }}" data-ajax="act=update_status|table=products|col=status|val={{ $key }}"> {{ $act }} </a>
                            </li>
                            @endforeach
                            <li>
                                <a href="javascript:;" class="btn-action" data-type="delete" data-ajax="act=delete_record|table=products|config=product|type={{ $type }}"> Xóa dữ liệu </a>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Excel
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{ route('qlyxe.product.export', array_merge(Request::query(),['extension'=>'xlsx']) ) }}"> Export Excel </a>
                            </li>
                            <li>
                                <a href="{{ route('qlyxe.product.export', array_merge(Request::query(),['extension'=>'csv ']) ) }}"> Export CSV </a>
                            </li>
                            <li>
                                <form role="form" method="POST" action="{{ route('qlyxe.product.import') }}" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <input type="file" name="file" class="hidden">
                                    <a href="javascript:;" class="btn-import"> Import </a>
                                </form>
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
                                @if($siteconfig[$type]['category'])
                                <th width="10%"> Danh mục </th>
                                @endif
                                <th width="25%"> Tiêu đề </th>
								@if($siteconfig[$type]['image'])
                                <th width="15%"> Hình ảnh </th>
                                @endif
                                <th width="10%"> Ngày tạo </th>
                                <th width="10%"> Tình trạng </th>
                                <th width="10%"> Thực thi </th>
							</tr>
						</thead>
						<tbody>
                            @forelse($items as $item)
                            <tr id="record-{{ $item->id }}">
                                <td align="center">
                                    <label class="mt-checkbox mt-checkbox-single">
                                        <input type="checkbox" name="id[]" class="checkable" value="{{ $item->id }}">
                                        <span></span>
                                    </label>
                                </td>
                                <td align="center"> <input type="text" name="priority" class="form-control input-mini input-priority" value="{{ $item->priority }}" data-ajax="act=update_priority|table=products|id={{ $item->id }}|col=priority"> </td>
                                @if($siteconfig[$type]['category'])
                                <td align="center"> {{ $item->category }} </td>
                                @endif
                                <td align="center"><a href="{{ route('qlyxe.product.edit',['id'=>$item->id, 'type'=>$type]) }}"> {{ $item->title }} </a></td>
                                @if($siteconfig[$type]['image'])
                                <td align="center">{!! ( ($item->image && file_exists(public_path(get_thumbnail($path.'/'.$item->image))) ) ? '<img src="'.asset( get_thumbnail('public/'.$path.'/'.$item->image) ).'" height="50" />' : '') !!}</td>
                                @endif
                                <td align="center"> {{ $item->created_at }} </td>
                                <td align="center">
                                    @foreach($siteconfig[$type]['status'] as $keyS => $valS)
                                        <button class="btn btn-sm btn-status btn-status-{{ $keyS}} btn-status-{{ $keyS.'-'.$item->id.' '.((strpos($item->status,$keyS) !== false)?'blue':'default') }}" data-loading-text="<i class='fa fa-spinner fa-pulse'></i>" data-ajax="act=update_status|table=products|id={{ $item->id }}|col=status|val={{ $keyS }}"> {{ $valS }} </button>
                                    @endforeach
                                </td>
                                <td align="center">
                                    <a href="{{ route('qlyxe.product.edit',['id'=>$item->id, 'type'=>$type]) }}" class="btn btn-sm blue" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
                                    <form action="{{ route('qlyxe.product.delete',['id'=>$item->id, 'type'=>$type]) }}" method="post">
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
				<div class="text-center"> {{ $items->appends($oldInput)->links() }} </div>
			</div>
		</div>
	</div>
</div>

<!-- Add Quickly Modal -->
<div id="quickly-modal" class="modal container fade" tabindex="-1" data-focus-on="input:first">
    <form role="form" method="POST" action="#">
        <input type="hidden" name="priority" value="1">
        <input type="hidden" name="status[]" value="publish">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title uppercase">Thêm nhanh</h4>
        </div>
        <div class="modal-body" id="qh-app">
            <div class="form-group">
                <label class="control-label">Danh mục</label>
                <div>
                    <select v-on:change="addProduct" name="data[parent]" class="selectpicker selectpicker-data show-tick show-menu-arrow form-control" multiple="">
                        <option value="0">Chọn danh mục</option>
                        @php
                            Menu::resetMenu();
                            Menu::setMenu($categories);
                            echo Menu::getMenuSelectLimit();
                        @endphp
                    </select>
                </div>
            </div>
            <qh-products></qh-products>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn default">Thoát</button>
            <button type="button" class="btn green btn-quick-add" data-ajax="data[category_id]" data-url="{{ route('admin.category.store',['type'=>$type]) }}"> <i class="fa fa-check"></i> Lưu</button>
        </div>
    </form>
</div>

@endsection

@section('custom_script')
<script src="{{ asset('public/packages/vue.js') }}" type="text/javascript"></script>
<script type="text/x-template" id="selectpicker-template">
    <table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th width="15%"> Tên xe </th>
                <th width="8%"> Số lượng </th>
                <th width="8%"> Giá theo giờ </th>
                <th width="8%"> Giá theo ngày </th>
                <th width="8%"> Giá theo tháng </th>
                <th width="3%"> Xóa </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, key) in products" >
                <td align="center">
                    <input type="hidden" :name="'products['+ key +'][category_id]'" v-model="item.category_id">
                    <input type="hidden" :name="'products['+ key +'][title]'" v-model="item.title">
                    @{{ item.title }}
                </td>
                <td align="center"> <input type="text" :name="'products['+ key +'][qty]'" class="form-control validate[required,min[1]]" v-model.number="item.qty"> </td>
                <td align="center"> <input type="text" :name="'products['+ key +'][original_price]'" class="form-control validate[required,min[1]]" v-model.number="item.original_price"> </td>
                <td align="center"> <input type="text" :name="'products['+ key +'][regular_price]'" class="form-control validate[required,min[1]]" v-model.number="item.regular_price"> </td>
                <td align="center"> <input type="text" :name="'products['+ key +'][sale_price]'" class="form-control validate[required,min[1]]" v-model.number="item.sale_price"> </td>
                <td align="center"> <button type="button" v-on:click="deleteProduct(item)" class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button> </td>
            </tr>
        </tbody>
    </table>
</script>
<script type="text/javascript">
    new Vue({
        el: '#qh-app',
        data: function () {
            var categories = [];
            var products = [];
            @if($categories)
                categories = {!! json_encode($categories) !!};
            @endif
            return {
                categories: categories,
                products: products
            };
        },
        computed: {
            total() {
                return this.products.reduce((total, item) => {
                    return total + (item.qty * item.price);
                }, 0) + this.shipping - this.coupon_amount;
            }
        },
        components: {
            'qh-products': {
                template: '#selectpicker-template',
                data: function () {
                    return {
                        products: this.$parent.products
                    };
                },
                computed: {
                    subtotal() {
                        return this.products.map((item) => {
                            return Number( item.qty * item.price )
                        });
                    },
                    total() {
                        return this.products.reduce((total, item) => {
                            return total + (item.qty * item.price);
                        }, 0);
                    }
                },
                methods: {
                    deleteProduct: function (item) {
                        this.products.splice(this.products.indexOf(item) ,1);
                    },
                    formatPrice(value) {
                        let val = (value/1).toFixed(0).replace('.', ',')
                        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                    }
                    
                }
            }
        },
        methods: {
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            addProduct: function () {
                var selectpicker = $(".selectpicker-data").val();
                for (var i = 0; i < selectpicker.length; i++) {
                    var flag = false;
                    for (var j = 0; j < this.products.length; j++) {
                        if( this.products[j].category_id == selectpicker[i] ){
                            flag = true;
                            break;
                        }
                    }
                    if(!flag){
                        this.products.push({
                            "category_id": selectpicker[i],
                            "title": this.categories[i].title,
                            "qty": 1,
                            "original_price": 0,
                            "regular_price": 0,
                            "sale_price": 0,
                        });
                    }
                }
            }
        }
    });
</script>
@endsection
