<?php $__env->startSection('title',__('Sign in to your account')); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="h4 text-body-emphasis mb-4"><?php echo e(__('Sign in to your account')); ?></h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="form"
          data-form-need-prevents-form-abandonment-value="false"
          data-action="form#submit"
          action="<?php echo e(route('platform.login.auth')); ?>">
        <?php echo csrf_field(); ?>

        <?php echo $__env->renderWhen($isLockUser,'platform::auth.lockme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>
        <?php echo $__env->renderWhen(!$isLockUser,'platform::auth.signin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('platform::auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/auth/login.blade.php ENDPATH**/ ?>