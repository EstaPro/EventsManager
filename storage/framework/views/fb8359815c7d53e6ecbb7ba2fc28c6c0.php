<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div class="simplemde-wrapper" data-controller="simplemde"
         data-simplemde-text-value='<?php echo \Illuminate\Support\Js::encode($value); ?>'>
        <textarea <?php echo e($attributes); ?>></textarea>
        <input class="d-none upload" type="file" data-action="simplemde#upload">
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/fields/simplemde.blade.php ENDPATH**/ ?>