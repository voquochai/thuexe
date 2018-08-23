<?php $__env->startSection('breadcrumb'); ?>
<li>
    <span> <?php echo e($pageTitle); ?> </span>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<?php echo $__env->make('qlyxe.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers"></i>Chọn loại xe cần nhập
                </div>
            </div>

            <div class="portlet-body" id="qh-app">
				<form role="form" method="POST" action="<?php echo e(route('qlyxe.product.quickly',['type'=>$type])); ?>" class="form-validation">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="control-label">Danh mục</label>
                        <div>
                            <select v-on:change="addProduct" class="selectpicker selectpicker-data show-tick show-menu-arrow form-control" multiple="">
                                <option value="0">Chọn danh mục</option>
                                <?php 
                                    Menu::resetMenu();
                                    Menu::setMenu($categories);
                                    echo Menu::getMenuSelectLimit();
                                 ?>
                            </select>
                        </div>
                    </div>
                    <qh-products></qh-products>
                    <div class="form-group">
                        <button type="submit" class="btn green"> <i class="fa fa-check"></i> Lưu</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>
<script src="<?php echo e(asset('public/packages/vue.js')); ?>" type="text/javascript"></script>
<script type="text/x-template" id="selectpicker-template">
    <div class="table-responsive">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th width="15%"> Loại xe </th>
                    <th width="8%"> Số lượng </th>
                    <th width="8%"> Giá theo giờ </th>
                    <th width="8%"> Giá theo ngày </th>
                    <th width="8%"> Giá theo tháng </th>
                    <th width="3%"> Xóa </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, key) in products" >
                    <td>
                        <input type="hidden" :name="'products['+ key +'][category_id]'" v-model="item.category_id">
                        <input type="hidden" :name="'products['+ key +'][title]'" v-model="item.title">
                        {{ item.title }}
                    </td>
                    <td align="center"> <input type="text" :name="'products['+ key +'][qty]'" class="form-control validate[required,min[1]]" v-model.number="item.qty"> </td>
                    <td align="center"> <input type="text" :name="'products['+ key +'][original_price]'" class="form-control validate[required,min[1]]" v-model.number="item.original_price"> </td>
                    <td align="center"> <input type="text" :name="'products['+ key +'][regular_price]'" class="form-control validate[required,min[1]]" v-model.number="item.regular_price"> </td>
                    <td align="center"> <input type="text" :name="'products['+ key +'][sale_price]'" class="form-control validate[required,min[1]]" v-model.number="item.sale_price"> </td>
                    <td align="center"> <button type="button" v-on:click="deleteProduct(item)" class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button> </td>
                </tr>
            </tbody>
        </table>
    </div>
</script>
<script type="text/javascript">
    new Vue({
        el: '#qh-app',
        data: function () {
            var categories = [];
            var products = [];
            <?php if($categories): ?>
                categories = <?php echo json_encode($categories); ?>;
            <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('qlyxe.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>