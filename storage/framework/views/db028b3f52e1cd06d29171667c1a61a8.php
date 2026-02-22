<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div data-controller="picture"
         data-picture-value="<?php echo e($attributes['value']); ?>"
         data-picture-storage="<?php echo e($storage ?? config('platform.attachment.disk', 'public')); ?>"
         data-picture-target="<?php echo e($target); ?>"
         data-picture-url="<?php echo e($url); ?>"
         data-picture-max-file-size="<?php echo e($maxFileSize); ?>"
         data-picture-accepted-files="<?php echo e($acceptedFiles); ?>"
         data-picture-groups="<?php echo e($attributes['groups'] ?? ''); ?>"
         data-picture-path="<?php echo e($attributes['path'] ?? ''); ?>"
    >
        <div class="border-dashed text-end p-3 picture-actions">

            <div class="fields-picture-container">
                <img src="#" class="picture-preview img-fluid img-full mb-2 border" alt="">
            </div>

            <span class="mt-1 float-start"><?php echo e(__('Upload image from your computer:')); ?></span>

            <div class="btn-group">
                <label class="btn btn-default m-0">
                    <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.cloud-arrow-up','class' => 'me-2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php endif; ?>

                    <?php echo e(__('Browse')); ?>

                    <input type="file"
                           accept="<?php echo e($acceptedFiles); ?>"
                           data-picture-target="upload"
                           data-action="change->picture#upload"
                           class="picture-input d-none">
                </label>

                <button type="button" class="btn btn-outline-danger picture-remove"
                        data-action="picture#clear"><?php echo e(__('Remove')); ?></button>
            </div>

            <input type="file"
                   accept="image/*"
                   class="d-none">
        </div>

        <input class="picture-path d-none"
               type="text"
               data-picture-target="source"
               <?php echo e($attributes); ?>

        >
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/fields/picture.blade.php ENDPATH**/ ?>