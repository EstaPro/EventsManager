<?php $__env->startSection('search', $query); ?>

<?php if(empty(!$radios)): ?>

        <?php echo $radios; ?>


<?php endif; ?>

<div class="bg-white shadow-sm rounded mb-3">
    <?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <a href="<?php echo e($item->url()); ?>" class="block py-2 px-3 dropdown-item" style="font-size: 0.85em;">

            <?php if(empty(!$item->image())): ?>
                <span class="pull-left thumb-xs rounded me-3">
                  <img src="<?php echo e($item->image()); ?>" alt="<?php echo e($item->title()); ?>">
                </span>
            <?php endif; ?>

            <span class="clear">
                <span class="text-ellipsis"><?php echo e($item->title()); ?></span>
                <small class="text-muted clear text-ellipsis">
                    <?php echo e($item->subTitle()); ?>

                </small>
            </span>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <div class="text-center pt-5 pb-5 w-100">
            <h3 class="fw-light">
                <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.funnel','class' => 'block mb-3 center'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

                <?php echo e(__('Nothing found.')); ?>

            </h3>

            <?php echo e(__('Try changing the query or type.')); ?>

        </div>
    <?php endif; ?>

    <div class="mt-2">
        <?php echo $__env->renderWhen($results instanceof \Illuminate\Contracts\Pagination\Paginator && $results->isNotEmpty(),
            'platform::layouts.pagination',
            ['paginator' => $results]
          , array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>
    </div>
</div>


<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/partials/result.blade.php ENDPATH**/ ?>