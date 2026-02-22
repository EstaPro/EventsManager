<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div class="form-check form-switch" data-controller="toggle">
        <input <?php echo e($attributes); ?>

               data-turbo="<?php echo e(var_export($turbo)); ?>"
               data-action="toggle#toggle"
               <?php if($status): echo 'checked'; endif; ?>
               id="<?php echo e($id); ?>"
        >
        <label class="form-check-label" for="<?php echo e($id); ?>"><?php echo e($name ?? ''); ?></label>

        <button
            data-controller="button"
            data-turbo="<?php echo e(var_export($turbo)); ?>"
            <?php if(empty(!$confirm)): ?>
                data-action="button#confirm"
                data-button-confirm="<?php echo e($confirm); ?>"
            <?php endif; ?>
            type="submit"
            data-toggle-target="button"
            <?php echo e($attributes->merge(['class' => 'd-none'])->except(['type'])); ?>>
        </button>
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/actions/toggle.blade.php ENDPATH**/ ?>