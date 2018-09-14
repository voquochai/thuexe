<section <?php if( @$bg_breadcrumb->image && file_exists(public_path('/uploads/photos/'.@$bg_breadcrumb->image)) ): ?> class="breadcrumb-section" style="background-image: url('<?php echo e(asset( 'public/uploads/photos/'.$bg_breadcrumb->image )); ?>')" <?php else: ?> class="breadcrumb-section no-background" <?php endif; ?> >
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p><?php echo e($site['title']); ?></p>
                    <ul class="breadcrumb">
                        <?php echo $breadcrumb; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SLIDER SECTION -->