<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div data-controller="map"
         data-map-id="<?php echo e($id); ?>"
         data-map-zoom="<?php echo e($zoom); ?>"
    >
        <div id="<?php echo e($id); ?>" class="osmap-map border mb-2 w-100" style="min-height: <?php echo e($attributes['height']); ?>">

        </div>
        <div class="row mt-3">
            <div class="col-md">
                <label for="<?php echo e($name); ?>[lat]"><?php echo e(__('Latitude')); ?></label>
                <input class="form-control"
                       id="marker__latitude"
                       data-map-target="lat"
                       <?php if($required ?? false): ?> required <?php endif; ?>
                       name="<?php echo e($name); ?>[lat]"
                       value="<?php echo e($value['lat'] ?? ''); ?>"/>
            </div>
            <div class="col-md">
                <label for="<?php echo e($name); ?>[lng]"><?php echo e(__('Longitude')); ?></label>
                <input class="form-control"
                       id="marker__longitude"

                       data-map-target="lng"
                       <?php if($required ?? false): ?> required <?php endif; ?>
                       name="<?php echo e($name); ?>[lng]"
                       value="<?php echo e($value['lng'] ?? ''); ?>"/>
            </div>
            <div class="col-md">
                <label><?php echo e(__('Object search')); ?></label>
                <input class="form-control" type="text"
                       value="<?php echo e($valuename ?? ''); ?>"
                       data-map-target="search"
                       data-action="keyup->map#search"/>
            </div>
        </div>

        <div class="marker-results"></div>

    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/fields/map.blade.php ENDPATH**/ ?>