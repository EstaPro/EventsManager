<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <?php if(isset($sendTrueOrFalse)): ?>
        <input hidden name="<?php echo e($attributes['name']); ?>" value="<?php echo e($attributes['novalue']); ?>">
        <div class="form-check form-switch">
            <input value="<?php echo e($attributes['yesvalue']); ?>"
                   <?php echo e($attributes); ?>

                   <?php if(isset($attributes['value']) && $attributes['value']): ?> checked <?php endif; ?>
                   id="<?php echo e($id); ?>"
            >
            <label class="form-check-label" for="<?php echo e($id); ?>"><?php echo e($placeholder ?? ''); ?></label>
        </div>
    <?php else: ?>
        <div class="form-check form-switch">
            <input <?php echo e($attributes); ?>

                   <?php if(isset($attributes['value']) && $attributes['value']): ?> checked <?php endif; ?>
            id="<?php echo e($id); ?>"
            >
            <label class="form-check-label" for="<?php echo e($id); ?>"><?php echo e($placeholder ?? ''); ?></label>
        </div>
    <?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/fields/switch.blade.php ENDPATH**/ ?>