<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div class="row">
        <div class="col-md-6 pe-1">
            <div class="form-group">
                <input type="<?php echo e($attributes['type']); ?>"
                       name="<?php echo e($attributes['name']); ?>[min]"
                       id='min_<?php echo e(\Illuminate\Support\Str::slug($attributes['name'])); ?>'
                       value="<?php echo e($value['min'] ?? null); ?>"
                       placeholder="<?php echo e(__('Minimum')); ?>"
                       <?php echo e($attributes); ?>

                       >
            </div>
        </div>

        <div class="col-md-6 ps-1">
            <div class="form-group">
                <input type="<?php echo e($attributes['type']); ?>"
                       name="<?php echo e($attributes['name']); ?>[max]"
                       id='max_<?php echo e(\Illuminate\Support\Str::slug($attributes['name'])); ?>'
                       value="<?php echo e($value['max'] ?? null); ?>"
                       placeholder="<?php echo e(__('Maximum')); ?>"
                       <?php echo e($attributes); ?>

                       >
            </div>
        </div>
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/fields/numberRange.blade.php ENDPATH**/ ?>