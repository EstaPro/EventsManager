<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div data-controller="attach"
         class="attach"
         data-attach-name-value="<?php echo e($name); ?>"
         data-attach-size-value="<?php echo e($maxSize); ?>"
         data-attach-count-value="<?php echo e($maxCount); ?>"
         data-attach-loading-value="0"
         data-attach-attachment-value='<?php echo json_encode($value ?? [], 15, 512) ?>'

         data-attach-storage-value="<?php echo e($storage ?? 'public'); ?>"
         data-attach-path-value="<?php echo e($path); ?>"
         data-attach-group-value="<?php echo e($group); ?>"

         data-attach-upload-url-value="<?php echo e($uploadUrl ?? route('platform.systems.files.upload')); ?>"
         data-attach-sort-url-value="<?php echo e($sortUrl ?? route('platform.systems.files.sort')); ?>"

         data-attach-error-size-value="<?php echo e($errorMaxSizeMessage); ?>"
         data-attach-error-type-value="<?php echo e($errorTypeMessage); ?>"

         data-action="
             drop->attach#dropFiles:prevent
             dragenter->attach#preventDefaults
             dragover->attach#preventDefaults
             dragleave->attach#preventDefaults
         "
    >
        <div data-target="attach.preview" class="row row-cols-4 row-cols-lg-6 gy-3 sortable-dropzone">
            <div class="col order-last attach-file-uploader" data-attach-target="container">
                <label for="<?php echo e($id); ?>" class="border rounded bg-light attach-image-placeholder pointer-event h-100">
                    <input class="form-control d-none"
                           type="file"
                           data-attach-target="files"
                           data-action="change->attach#selectFiles"
                           disabled
                        <?php echo e($attributes); ?>

                    >

                    <span class="d-block text-center fw-normal small text-muted p-3 mx-auto">
                    <span class="choose d-flex flex-column gap-2 align-items-center text-balance text-wrap">
                            <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.cloud-arrow-up','class' => 'h3'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                            <small class="text-muted d-block"><?php echo e(__($placeholder)); ?></small>
                    </span>

                    <span class="spinner-border" role="status">
                        <span class="visually-hidden"><?php echo e(__('Loading...')); ?></span>
                    </span>
                </span>
                </label>
                <input type="hidden" name="<?php echo e($name); ?>" data-attach-target="nullable" value="">
            </div>
        </div>


        <template data-attach-target="template">
            <div class="pip col position-relative">
                <input type="hidden" name="{name}" value="{id}">


                <img class="attach-image rounded border user-select-none overflow-hidden"
                     src="{url}"
                     loading="lazy"
                     title="{original_name}"/>

                

                <button class="btn-close rounded-circle bg-white border shadow position-absolute end-0 top-0"
                        type="button" data-action="click->attach#remove" data-index="{id}"></button>
            </div>
        </template>

    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/fields/attach.blade.php ENDPATH**/ ?>