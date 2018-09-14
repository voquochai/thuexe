<?php if($paginator->hasPages()): ?>
    <ul class="list-inline list-unstyled">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="prev disabled"><a href="javascript:void(0)" class="page-link"><i class="fa fa-angle-left"></i></a></li>
        <?php else: ?>
            <li class="prev"><a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev"><i class="fa fa-angle-left"></i></a></li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="disabled"><a href="javascript:void(0)" class="page-link"><?php echo e($element); ?></a></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="active"><a href="javascript:void(0)" class="page-link"><?php echo e($page); ?></a></li>
                    <?php else: ?>
                        <li><a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="next"><a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"><i class="fa fa-angle-right"></i></a></li>
        <?php else: ?>
            <li class="next disabled"><a href="javascript:void(0)" class="page-link"><i class="fa fa-angle-right"></i></a></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>