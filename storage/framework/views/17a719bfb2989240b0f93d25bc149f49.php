<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div data-controller="cropper"
         data-cropper-value="<?php echo e($attributes['value']); ?>"
         data-cropper-storage="<?php echo e($storage ?? config('platform.attachment.disk', 'public')); ?>"
         data-cropper-width="<?php echo e($width); ?>"
         data-cropper-height="<?php echo e($height); ?>"
         data-cropper-min-width="<?php echo e($minWidth); ?>"
         data-cropper-min-height="<?php echo e($minHeight); ?>"
         data-cropper-max-width="<?php echo e($maxWidth); ?>"
         data-cropper-max-height="<?php echo e($maxHeight); ?>"
         data-cropper-target="<?php echo e($target); ?>"
         data-cropper-url="<?php echo e($url); ?>"
         data-cropper-accepted-files="<?php echo e($acceptedFiles); ?>"
         data-cropper-max-file-size="<?php echo e($maxFileSize); ?>"
         data-cropper-groups="<?php echo e($attributes['groups']); ?>"
         data-cropper-path="<?php echo e($attributes['path'] ?? ''); ?>"
         data-cropper-keep-original-type-value="<?php echo e($keepOriginalType); ?>"
         data-cropper-max-size-message-value="<?php echo e(__($maxSizeValidateMessage)); ?>"
         data-cropper-image-smoothing-enabled="<?php echo e($imageSmoothingEnabled); ?>"
         data-cropper-image-smoothing-quality="<?php echo e($imageSmoothingQuality); ?>"
         data-cropper-fill-color="<?php echo e($fillColor); ?>"
    >
        <div class="border-dashed text-end p-3 cropper-actions">

            <div class="fields-cropper-container">
                <img src="#" class="cropper-preview img-fluid img-full mb-2 border" alt="" style="--cropper-width: <?php echo e($width); ?>; --cropper-height: <?php echo e($height); ?>;">
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
                           data-cropper-target="upload"
                           data-action="change->cropper#upload click->cropper#openModal"
                           class="d-none">
                </label>

                <button type="button" class="btn btn-outline-danger cropper-remove"
                        data-action="cropper#clear"><?php echo e(__('Remove')); ?></button>
            </div>

            <input type="file"
                   accept="<?php echo e($acceptedFiles); ?>"
                   class="d-none">
        </div>

        <input class="cropper-path d-none"
               type="text"
               data-cropper-target="source"
            <?php echo e($attributes); ?>

        >

        <div class="modal" role="dialog" <?php echo e($staticBackdrop ? "data-bs-backdrop=static" : ''); ?>>
            <div class="modal-dialog modal-fullscreen-md-down modal-lg">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="position-relative">
                            <img class="upload-panel">
                        </div>

                        <div class="modal-footer">

                            <button type="button"
                                    class="btn btn-link"
                                    data-bs-dismiss="modal">
                                <?php echo e(__('Close')); ?>

                            </button>

                            <button type="button"
                                    class="btn btn-default"
                                    data-action="cropper#crop">
                                <?php echo e(__('Crop')); ?>

                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/fields/cropper.blade.php ENDPATH**/ ?>