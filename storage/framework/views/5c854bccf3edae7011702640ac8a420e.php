<?php $__env->startComponent($typeForm, get_defined_vars()); ?>
    <div data-controller="radiobutton">
        <div class="btn-group btn-group-toggle p-0" data-toggle="buttons">

            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="btn btn-default <?php if($active($key, $value)): ?> active <?php endif; ?>"
                       data-action="click->radiobutton#checked"
                >
                   <input <?php echo e($attributes->except('id')); ?>

                           <?php if($active($key, $value)): ?> checked <?php endif; ?>
                            value="<?php echo e($key); ?>" id="<?php echo e($key); ?>-<?php echo e($id); ?>"
                    ><?php echo e($option); ?></label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/fields/radiobutton.blade.php ENDPATH**/ ?>