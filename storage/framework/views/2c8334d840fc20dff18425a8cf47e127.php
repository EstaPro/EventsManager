<div class="avatar-group d-flex">
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($user->url()); ?>" class="avatar thumb-xs"
           data-controller="tooltip"
           data-action="mouseover->tooltip#mouseOver"
           data-toggle="tooltip"
           data-placement="top"
           title="<?php echo e($user->title()); ?>">
            <img src="<?php echo e($user->image()); ?>"
                 class="avatar-img rounded-circle b bg-light"
                 alt="<?php echo e($user->title()); ?>">
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/layouts/facepile.blade.php ENDPATH**/ ?>