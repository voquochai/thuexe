<?php $__env->startSection('breadcrumb'); ?>
<li>
    <a href="<?php echo e(route('admin.category.index', ['type'=>$type])); ?>"> <?php echo e($pageTitle); ?> </a>
    <i class="fa fa-circle"></i>
</li>
<li>
    <span> Thêm mới</span>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('admin.blocks.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- BEGIN FORM-->
    <form role="form" method="POST" action="<?php echo e(route('admin.category.store',['type'=>$type])); ?>" enctype="multipart/form-data" >
        <?php echo e(csrf_field()); ?>

        <div class="col-lg-9 col-xs-12"> 
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"> Nội dung </div>
                    <ul class="nav nav-tabs">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="#tab_<?php echo e($key); ?>" data-toggle="tab" aria-expanded="false"> <?php echo e($lang); ?> </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane" id="tab_<?php echo e($key); ?>">
                            <div class="form-group">
                                <label for="name" class="control-label">Tên</label>
                                <div>
                                    <input type="text" class="form-control <?php echo (( $key==$default_language )?'title':''); ?>" name="dataL[<?php echo e($key); ?>][title]" value="<?php echo e(old('dataL.'.$key.'.title')); ?>">
                                </div>
                            </div>

                            <?php if($siteconfig[$type]['description']): ?>
                            <div class="form-group">
                                <label for="description" class="control-label">Mô tả</label>
                                <div>
                                    <textarea name="dataL[<?php echo e($key); ?>][description]" class="form-control" rows="6"><?php echo e(old('dataL.'.$key.'.description')); ?></textarea>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($siteconfig[$type]['contents']): ?>
                            <div class="form-group">
                                <label class="control-label">Nội dung</label>
                                <div class="ck-editor">
                                    <textarea name="dataL[<?php echo e($key); ?>][contents]" id="contents_<?php echo e($key); ?>" class="form-control content" rows="6"><?php echo e(old('dataL.'.$key.'.contents')); ?></textarea>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($siteconfig[$type]['seo']): ?>
                            <div class="form-group">
                                <label class="control-label">Meta Title</label>
                                <div>
                                    <input type="text" name="dataL[<?php echo e($key); ?>][meta_seo][title]" class="form-control meta-title" value="<?php echo e(old('dataL.'.$key.'.meta_seo.title')); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Meta Keywords</label>
                                <div>
                                    <textarea name="dataL[<?php echo e($key); ?>][meta_seo][keywords]" class="form-control meta-keywords" rows="6"><?php echo e(old('dataL.'.$key.'.meta_seo.keywords')); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Meta Description</label>
                                <div>
                                    <textarea name="dataL[<?php echo e($key); ?>][meta_seo][description]" class="form-control meta-description" rows="6"><?php echo e(old('dataL.'.$key.'.meta_seo.description')); ?></textarea>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="form-group">
                        <label class="control-label">Danh mục cha</label>
                        <div>
                            <select name="data[parent]" class="selectpicker show-tick show-menu-arrow form-control">
                                <option value="0">Chọn danh mục</option>
                                <?php 
                                    Menu::setMenu($categories);
                                    echo Menu::getMenuSelectLimit(0,0,'',old('data.parent'));
                                 ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Slug</label>
                        <div>
                            <input type="text" name="dataL[vi][slug]" class="form-control slug" value="<?php echo e(old('dataL.'.$key.'.slug')); ?>">
                        </div>
                    </div>
                    <?php if($siteconfig[$type]['image']): ?>
                    <div class="form-group">
                        <label class="control-label">Hình ảnh</label>
                        <div>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="<?php echo e(asset('noimage/'.$thumbs['_small']['width'].'x'.$thumbs['_small']['height'])); ?>" alt="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                <div>
                                    <span class="btn default btn-file">
                                    <span class="fileinput-new"> Chọn hình ảnh </span>
                                    <span class="fileinput-exists"> Thay đổi </span>
                                    <input type="file" name="image"> </span>
                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Xóa </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alt</label>
                        <div>
                            <input type="text" name="data[alt]" class="form-control" value="<?php echo e(old('data.alt')); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($siteconfig[$type]['icon']): ?>
                    <div class="form-group">
                        <label class="control-label"> <a href="https://fontawesome.com/v4.7.0/icons/" rel="nofollow" target="_blank"> Font Icon </a> </label>
                        <div>
                            <input type="text" name="data[icon]" class="form-control" value="<?php echo e(old('data.icon')); ?>">
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="control-label">Tình trạng</label>
                        <div>
                            <select class="selectpicker show-tick show-menu-arrow form-control" name="status[]" multiple>
                                <?php $__currentLoopData = $siteconfig[$type]['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e((old('status')) ? ( (in_array($key,old('status'))) ? 'selected' : '') : ($key=='publish')?'selected':''); ?> > <?php echo e($val); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Thứ tự</label>
                        <div>
                            <input type="text" name="priority" class="form-control priceFormat" value="<?php echo e((old('priority')) ? old('priority') : 1); ?>">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>