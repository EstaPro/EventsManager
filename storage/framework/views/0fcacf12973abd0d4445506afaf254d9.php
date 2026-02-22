<?php $__env->startSection('title',__('Access Denied: Viewing as Another User')); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="h4 text-body-emphasis mb-4"><?php echo e(__('Limited Access')); ?></h1>

    <form role="form"
          method="POST"
          data-controller="form"
          data-form-need-prevents-form-abandonment-value="false"
          data-action="form#submit"
          action="<?php echo e(route('platform.switch.logout')); ?>">
        <?php echo csrf_field(); ?>

        <p>
            <?php echo e(__("You are currently viewing this page on behalf of a user who does not have access to it. To return to viewing as yourself, please click the 'Switch to My Account' button. It's possible that the page may be displayed correctly when viewed from your own account.")); ?>

        </p>

        <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="2">
            <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.box-arrow-in-right','class' => 'small me-2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('orchid-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Orchid\Icons\IconComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal385240e1db507cd70f0facab99c4d015)): ?>
<?php $attributes = $__attributesOriginal385240e1db507cd70f0facab99c4d015; ?>
<?php unset($__attributesOriginal385240e1db507cd70f0facab99c4d015); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal385240e1db507cd70f0facab99c4d015)): ?>
<?php $component = $__componentOriginal385240e1db507cd70f0facab99c4d015; ?>
<?php unset($__componentOriginal385240e1db507cd70f0facab99c4d015); ?>
<?php endif; ?> <?php echo e(__('Switch to My Account')); ?>

        </button>

    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('platform::auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/auth/impersonation.blade.php ENDPATH**/ ?>