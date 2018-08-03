<div class="col-md-12" id="alert-container">
	<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	    <ul>
	        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	            <li><?php echo $error; ?></li>
	        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    </ul>
	</div>
	<?php endif; ?>
	
	<?php if(session('danger')): ?>
	<div class="note note-danger">
	    <p> THÔNG BÁO: <?php echo session('danger'); ?>. </p>
	</div>
	<?php endif; ?>

	<?php if(session('success')): ?> 
	<div class="note note-success">
	    <p> THÔNG BÁO: <?php echo session('success'); ?>. </p>
	</div>
	<?php endif; ?>

	<?php if(session('status')): ?>
    <div class="alert alert-success">
        <?php echo e(session('status')); ?>

    </div>
    <?php endif; ?>
</div>