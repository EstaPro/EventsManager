<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div data-controller="quill"
         data-quill-toolbar='<?php echo json_encode($toolbar, 15, 512) ?>'
         data-quill-base64='<?php echo json_encode($base64, 15, 512) ?>'
         data-quill-value='<?php echo json_encode($value, 15, 512) ?>'
         data-quill-groups="<?php echo e($attributes['groups'] ?? ''); ?>"
         data-theme="<?php echo e($theme ?? 'inlite'); ?>"
    >
        <div id="toolbar"></div>
        <div class="quill p-3 position-relative" id="quill-wrapper-<?php echo e($id); ?>"
             style="min-height: <?php echo e($attributes['height']); ?>">
        </div>
        <textarea class="d-none" <?php echo e($attributes); ?>></textarea>
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/fields/quill.blade.php ENDPATH**/ ?>