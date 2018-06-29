<p><?php echo e(__('site.newsletter_message')); ?></p>
<form action="#" method="post">
    <div class="form-group">
        <input type="email" value="" name="email" class="form-control" placeholder="Email Address" required>
    </div>
    <button type="submit" class="btn btn-warning btn-ajax" data-ajax="act=newsletter|type=newsletter"> <?php echo e(__('account.register')); ?> </button>
</form>