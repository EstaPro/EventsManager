<?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<?php if(empty(!$group['label'])): ?>
    <div class="hidden-folded text-muted small"><?php echo e($group['label']); ?></div>
<?php endif; ?>

<?php $__currentLoopData = $group['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="p-2 list-group-item-action d-flex gap-3 align-items-start position-relative rounded overflow-hidden">

        <?php if(empty(!$item->image())): ?>
            <div class="thumb-sm rounded overflow-hidden">
                <img src="<?php echo e($item->image()); ?>" alt="<?php echo e($item->title()); ?>">
            </div>
        <?php endif; ?>

        <div class="d-flex flex-column">
            <div class="text-balance">
                <a href="<?php echo e($item->url()); ?>"
                   class="stretched-link link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    <?php echo e($item->title()); ?>

                </a>
            </div>
            <div class="text-muted small text-balance">
                <?php echo e($item->subTitle()); ?>

            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

    <p class="ms-3 me-3 mb-0 text-center">
        <?php echo e(__('There are no records in this view.')); ?>

    </p>

<?php endif; ?>


<?php if($total >= 5): ?>
    <a href="<?php echo e(route('platform.search', $query)); ?>" class="block py-2 px-3 dropdown-item border-top pb-1">
        <span class="small ps-1">
            <?php echo e(__('See more results.')); ?>

            <span class="text-muted">(<?php echo e($total); ?>)</span>
        </span>
    </a>
<?php endif; ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/partials/result-compact.blade.php ENDPATH**/ ?>