<?php $__env->startSection('breadcrumb'); ?>
<li>
    <a href="<?php echo e(route('admin.post.index', ['type'=>$type])); ?>"> <?php echo e($pageTitle); ?> </a>
    <i class="fa fa-circle"></i>
</li>
<li>
    <span>Chỉnh sửa</span>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('admin.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- BEGIN FORM-->
    <form role="form" method="POST" action="<?php echo e(route('admin.post.update',['id'=>$item->id,'type'=>$type])); ?>" enctype="multipart/form-data" >
        <?php echo e(csrf_field()); ?>

        <?php echo e(method_field('put')); ?>

        <input type="hidden" name="redirects_to" value="<?php echo e((old('redirects_to')) ? old('redirects_to') : url()->previous()); ?>" />
        <div class="col-lg-9 col-xs-12"> 
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"> Chỉnh sửa </div>
                    <ul class="nav nav-tabs">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="#tab_<?php echo e($key); ?>" data-toggle="tab" aria-expanded="false"> <?php echo e($lang); ?> </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($siteconfig[$type]['images']): ?>
                        <li>
                            <a href="#tab_images" data-toggle="tab" aria-expanded="false"> Thư viện ảnh </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <?php  $i=0;  ?>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane" id="tab_<?php echo e($key); ?>">
                            <div class="form-group">
                                <label for="name" class="control-label">Tên</label>
                                <div>
                                    <input type="text" class="form-control <?php echo (( $key==$default_language ) ? 'title' : ''); ?>" name="dataL[<?php echo e($key); ?>][title]" value="<?php echo e(isset( $item->languages[$i] ) ? $item->languages[$i]['title'] : ''); ?>">
                                </div>
                            </div>

                            <?php if($siteconfig[$type]['description']): ?>
                            <div class="form-group">
                                <label for="description" class="control-label">Mô tả</label>
                                <div>
                                    <textarea name="dataL[<?php echo e($key); ?>][description]" class="form-control" rows="6"><?php echo e(isset( $item->languages[$i] ) ? $item->languages[$i]['description'] : ''); ?></textarea>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($siteconfig[$type]['contents']): ?>
                            <div class="form-group">
                                <label class="control-label">Nội dung</label>
                                <div class="ck-editor">
                                    <textarea name="dataL[<?php echo e($key); ?>][contents]" id="contents_<?php echo e($key); ?>" class="form-control content" rows="6"><?php echo e(isset( $item->languages[$i] ) ? $item->languages[$i]['contents'] : ''); ?></textarea>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($siteconfig[$type]['seo']): ?>
                            <div class="form-group">
                                <label class="control-label">Meta Title</label>
                                <div>
                                    <input type="text" name="dataL[<?php echo e($key); ?>][meta_seo][title]" class="form-control meta-title" value="<?php echo e(isset( $item->languages[$i] ) ? $item->languages[$i]->meta_seo['title'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Meta Keywords</label>
                                <div>
                                    <textarea name="dataL[<?php echo e($key); ?>][meta_seo][keywords]" class="form-control meta-keywords" rows="6"><?php echo e(isset( $item->languages[$i] ) ? $item->languages[$i]->meta_seo['keywords'] : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Meta Description</label>
                                <div>
                                    <textarea name="dataL[<?php echo e($key); ?>][meta_seo][description]" class="form-control meta-description" rows="6"><?php echo e(isset( $item->languages[$i] ) ? $item->languages[$i]->meta_seo['description'] : ''); ?></textarea>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($siteconfig[$type]['attributes']): ?>
                            <div id="qh-app-<?php echo e($key); ?>">
                                <label class="control-label">Thuộc tính</label>
                                <qh-attributes-<?php echo e($key); ?>></qh-attributes-<?php echo e($key); ?>>
                            </div>
                            <?php endif; ?>

                        </div>
                        <?php  $i++  ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($siteconfig[$type]['images']): ?>
                        <div class="tab-pane" id="tab_images">
                            <div class="text-align-reverse margin-bottom-10">
                                <input type="file" name="files" data-fileuploader-files='[
                                <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php echo e((($key > 0) ? ',' : '')); ?>

                                    {
                                        "name":"<?php echo e($image->image); ?>",
                                        "size": <?php echo e($image->size); ?>,
                                        "type":"<?php echo e($image->mime_type); ?>",
                                        "file":"<?php echo e(asset('public/'.$path.'/'.$image->image.'?v='.time())); ?>",
                                        "data":{
                                            "id":"<?php echo e($image->id); ?>",
                                            "alt":"<?php echo e($image->alt); ?>",
                                            "priority":"<?php echo e($image->priority); ?>",
                                            "url":"<?php echo e(route('download.file',$path.'/'.$image->image)); ?>",
                                            "config":"post",
                                            "type":"<?php echo e($type); ?>"
                                        }
                                    }
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                                ]'>
                            </div>
                            <div class="fileuploader-items"></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($siteconfig[$type]['seo']): ?>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"> SEO </div>
                    <div class="actions">
                        <a href="javascript:;" id="refresh-analysis" class="btn btn-sm btn-default"> Refresh! </a>
                    </div>
                </div>
                <div class="portlet-body" id="yoast-seo">
                    <div class="row">
                        <div class="col-xs-12 hidden">
                            <label for="locale">Locale</label>
                            <input type="text" id="locale" name="locale" placeholder="en_US" />
                            <label for="content">Text</label>
                            <textarea id="content" name="content" placeholder="Start writing your text!"></textarea>
                            <label for="focusKeyword">Focus keyword</label>
                            <input type="text" id="focusKeyword" name="focusKeyword" placeholder="Choose a focus keyword" />
                        </div>
                        <div class="col-xs-12">
                            <div id="snippet" class="output"> </div>
                        </div>
                        <div class="col-xs-12">
                            <div id="output-container" class="output-container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4>Đánh giá SEO</h4>
                                        <div id="output" class="output"></div>
                                    </div>
                                    <div class="col-xs-12">
                                        <h4>Đánh giá nội dung</h4>
                                        <div id="contentOutput" class="output"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-3 col-xs-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">Thông tin chung </div>
                </div>
                <div class="portlet-body">
                    <?php if($siteconfig[$type]['category']): ?>
                    <div class="form-group">
                        <label class="control-label"> <a href="#" title="Thêm danh mục" data-target="#category-modal" data-toggle="modal" class="sbold"> Danh mục </a> </label>
                        <div>
                            <select name="data[category_id]" class="selectpicker show-tick show-menu-arrow form-control">
                                <?php 
                                    Menu::setMenu($categories);
                                    echo Menu::getMenuSelect(0,0,'',$item->category_id);
                                 ?>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($siteconfig[$type]['post_tags']): ?>
                    <div class="form-group">
                        <label class="control-label"> <a href="#" title="Thêm thẻ" data-target="#tags-modal" data-toggle="modal" class="sbold"> Thẻ </a> </label>
                        <div>
                            <select name="tags[]" class="selectpicker show-tick show-menu-arrow form-control" multiple>
                                <?php $__empty_1 = true; $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($tag->id); ?>" <?php echo e(( in_array($tag->id,$item->getIdsAttribute('post_tags')) ) ? 'selected' : ''); ?> > <?php echo e($tag->title); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label class="control-label">Slug</label>
                        <div>
                            <input type="text" name="dataL[vi][slug]" class="form-control slug" value="<?php echo e($item->languages[0]->slug); ?>">
                        </div>
                    </div>

                    <?php if($siteconfig[$type]['image']): ?>
                    <div class="form-group">
                        <label class="control-label">Hình ảnh</label>
                        <div>
                            <div class="fileinput <?php echo e(( $item->image && file_exists(public_path(get_thumbnail($path.'/'.$item->image))) ) ? 'fileinput-exists' : 'fileinput-new'); ?>" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="<?php echo e(asset('noimage/'.$thumbs['_small']['width'].'x'.$thumbs['_small']['height'])); ?>" alt="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail">
                                    <?php if( $item->image && file_exists(public_path(get_thumbnail($path.'/'.$item->image))) ): ?>
                                    <img src="<?php echo e(asset( get_thumbnail('public/'.$path.'/'.$item->image) )); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Chọn hình ảnh </span>
                                        <span class="fileinput-exists"> Thay đổi </span>
                                        <input type="file" name="image">
                                    </span>
                                    <a href="javascript:;" class="btn btn-delete-file default fileinput-exists" data-dismiss="fileinput" data-ajax="act=delete_file|path=<?php echo e($path.'/'.$item->image); ?>|thumbs=<?php echo e(json_encode($thumbs)); ?>"> Xóa </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alt</label>
                        <div>
                            <input type="text" name="data[alt]" value="<?php echo e($item->alt); ?>" class="form-control">
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($siteconfig[$type]['link']): ?>
                    <div class="form-group">
                        <label class="control-label">Link</label>
                        <div>
                            <input type="text" name="data[link]" value="<?php echo e($item->link); ?>" class="form-control">
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="control-label">Tình trạng</label>
                        <div>
                            <select class="selectpicker show-tick show-menu-arrow form-control" name="status[]" multiple>
                                <optgroup >
                                    <?php $__currentLoopData = $siteconfig[$type]['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e((strpos($item->status,$key) !== false)?'selected':''); ?> > <?php echo e($val); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Thứ tự</label>
                        <div>
                            <input type="text" name="priority" value="<?php echo e($item->priority); ?>" class="form-control priceFormat">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn green"> <i class="fa fa-check"></i> Lưu</button>
                        <a href="<?php echo e(url()->previous()); ?>" class="btn default" > Thoát </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php if($siteconfig[$type]['category']): ?>
<!-- Add Category Modal -->
<div id="category-modal" class="modal fade" tabindex="-1" data-focus-on="input:first">
    <form role="form" method="POST" action="#">
        <input type="hidden" name="priority" value="1">
        <input type="hidden" name="status[]" value="publish">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title uppercase">Thêm danh mục</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label">Danh mục cha</label>
                <div>
                    <select name="data[parent]" class="selectpicker show-tick show-menu-arrow form-control">
                        <option value="0">Chọn danh mục</option>
                        <?php 
                            Menu::resetMenu();
                            Menu::setMenu($categories);
                            echo Menu::getMenuSelectLimit();
                         ?>
                    </select>
                </div>
            </div>
            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group">
                <label for="name" class="control-label">Tên <sub>(<?php echo e($lang); ?>)</sub> </label>
                <div>
                    <input type="text" class="form-control input-rs" name="dataL[<?php echo e($key); ?>][title]" value="">
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn default">Thoát</button>
            <button type="button" class="btn green btn-quick-add" data-ajax="data[category_id]" data-url="<?php echo e(route('admin.category.store',['type'=>$type])); ?>"> <i class="fa fa-check"></i> Lưu</button>
        </div>
    </form>
</div>
<?php endif; ?>

<?php if($siteconfig[$type]['post_tags']): ?>
<!-- Add Tags Modal -->
<div id="tags-modal" class="modal fade" tabindex="-1" data-focus-on="input:first">
    <form role="form" method="POST" action="#">
        <input type="hidden" name="priority" value="1">
        <input type="hidden" name="status[]" value="publish">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title uppercase">Thêm thẻ</h4>
        </div>
        <div class="modal-body">
            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group">
                <label for="name" class="control-label">Tên <sub>(<?php echo e($lang); ?>)</sub> </label>
                <div>
                    <input type="text" class="form-control input-rs" name="dataL[<?php echo e($key); ?>][title]" value="">
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn default">Thoát</button>
            <button type="button" class="btn green btn-quick-add" data-ajax="tags[]" data-url="<?php echo e(route('admin.attribute.store',['type'=>'post_tags'])); ?>"> <i class="fa fa-check"></i> Lưu</button>
        </div>
    </form>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>
    <?php if($siteconfig[$type]['attributes']): ?>
        <?php  $i=0;  ?>
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script type="text/x-template" id="qh-attributes-template-<?php echo e($key); ?>">
            <div>
                <div class="form-group" v-for="(item, key) in attributes">
                    <div class="row">
                        <div class="col-lg-3">
                            <input type="text" :name="'attributes[<?php echo e($key); ?>]['+ key +'][name]'" v-model="item.name" class="form-control" placeholder="Thuộc tính">
                        </div>
                        <div class="col-lg-7">
                            <input type="text" :name="'attributes[<?php echo e($key); ?>]['+ key +'][value]'" v-model="item.value" class="form-control" placeholder="Giá trị">
                        </div>
                        <div class="col-lg-2">
                            <button type="button" v-if="key != 0" v-on:click="deleteAttribute(item)" class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button>
                            <button type="button" v-if="key == (attributes.length - 1)" v-on:click="addAttribute" class="btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </script>
        <script type="text/javascript">
            <?php 
            $attributes = $item->languages[$i]['original']['attributes'] ? $item->languages[$i]['original']['attributes'] : null;
             ?>
            Vue.component('qh-attributes-<?php echo e($key); ?>', {
                template: '#qh-attributes-template-<?php echo e($key); ?>',
                data: function () {
                    var attributes = [
                        {name: '', value: ''}
                    ];
                    <?php if($attributes): ?>
                        attributes = <?php echo $attributes; ?>;
                    <?php endif; ?>
                    return {
                        attributes: attributes
                    };
                },
                methods: {
                    addAttribute: function () {
                        this.attributes.push({name: '', value: ''});
                    },
                    deleteAttribute: function (item) {
                        this.attributes.splice(this.attributes.indexOf(item) ,1);
                    }
                }
            });
            new Vue({
                el: '#qh-app-<?php echo e($key); ?>'
            });
        </script>
        <?php  $i++  ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>