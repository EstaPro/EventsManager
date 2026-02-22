<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div class="row" data-controller="datetime"
         data-datetime-allow-input="true"
         data-datetime-range="#end_<?php echo e($attributes['id']); ?>"
         <?php echo e($dataAttributes); ?>>
        <div class="col-md-6 pe-auto pe-md-1">
            <div class="form-group">
                <input type="text"
                       <?php if(isset($attributes['form'])): ?> form="<?php echo e($attributes['form'] ?? null); ?>" <?php endif; ?>
                       name="<?php echo e($attributes['name']); ?>[start]"
                       id='start_<?php echo e($attributes['id']); ?>'
                       data-datetime-target="instance"
                       value="<?php echo e($value['start'] ?? null); ?>"
                       class="form-control">
            </div>
        </div>

        <div class="col-md-6 ps-auto ps-md-1">
            <div class="form-group">
                <input type="text"
                       <?php if(isset($attributes['form'])): ?> form="<?php echo e($attributes['form'] ?? null); ?>" <?php endif; ?>
                       name="<?php echo e($attributes['name']); ?>[end]"
                       data-datetime-target="instance"
                       id='end_<?php echo e($attributes['id']); ?>'
                       value="<?php echo e($value['end'] ?? null); ?>"
                       class="form-control">
            </div>
        </div>
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/fields/dataRange.blade.php ENDPATH**/ ?>