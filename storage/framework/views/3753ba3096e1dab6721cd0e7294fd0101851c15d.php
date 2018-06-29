<?php $__env->startSection('breadcrumb'); ?>
<li>
    <a href="<?php echo e(route('admin.seo.index')); ?>"> <?php echo e($pageTitle); ?> </a>
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
    <form role="form" method="POST" action="<?php echo e(route('admin.seo.update',['id'=>$item->id])); ?>" enctype="multipart/form-data" >
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

                        </div>
                        <?php  $i++  ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
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
        </div>
        <div class="col-lg-3 col-xs-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">Thông tin chung </div>
                </div>
                <div class="portlet-body">
                    <div class="form-group <?php if($item->id == 1): ?> hidden <?php endif; ?>">
                        <label class="control-label">Link</label>
                        <div>
                            <input type="text" name="data[link]" value="<?php echo e($item->link); ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group <?php if($item->id == 1): ?> hidden <?php endif; ?>">
                        <label class="control-label">Tình trạng</label>
                        <div>
                            <select class="selectpicker show-tick show-menu-arrow form-control" name="status[]" multiple>
                                <option value="publish" <?php echo e((strpos($item->status,'publish') !== false)?'selected':''); ?> > Hiển thị </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group <?php if($item->id == 1): ?> hidden <?php endif; ?>">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>