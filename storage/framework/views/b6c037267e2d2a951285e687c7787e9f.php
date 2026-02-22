<?php if(empty(!$title)): ?>
    <fieldset>
        <div class="col p-0 px-3">
            <legend class="text-body-emphasis mt-2 mx-2">
                <?php echo e($title); ?>

            </legend>
        </div>
    </fieldset>
<?php endif; ?>

<div class="mb-3 rounded shadow-sm overflow-hidden">
    <?php if($rows->isNotEmpty()): ?>
        <ol
            data-controller="sortable"
            data-sortable-selector-value=".reorder-handle"
            data-sortable-model-value="<?php echo e(get_class($rows->first())); ?>"
            data-sortable-action-value="<?php echo e(route('platform.systems.sorting')); ?>"
            data-sortable-success-message-value="<?php echo e($successSortMessage); ?>"
            data-sortable-failure-message-value="<?php echo e($failureSortMessage); ?>"
            class="list-group">

            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li
                    data-model-id="<?php echo e($model->getKey()); ?>"
                    class="reorder-handle list-group-item d-flex justify-content-between align-items-center px-4 py-3 list-group-item-action">
                    <div class="me-4">
                        <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.arrow-down-up','class' => 'cursor-move'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                    </div>

                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="<?php echo e($loop->first ? 'me-auto' : 'ms-3'); ?>">
                            <?php if($showBlockHeaders): ?>
                                <div class="text-muted fw-normal">
                                    <?php echo $column->buildDt($model); ?>

                                </div>
                            <?php endif; ?>

                            <?php echo $column->buildDd($model); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    <?php else: ?>
        <div class="d-md-flex align-items-center px-md-0 px-2 pt-4 pb-5 w-100 text-md-start text-center">
            <?php if(isset($iconNotFound)): ?>
                <div class="col-auto mx-md-4 mb-3 mb-md-0">
                    <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => $iconNotFound,'class' => 'block h1'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                </div>
            <?php endif; ?>

            <div>
                <h3 class="fw-light">
                    <?php echo $textNotFound; ?>

                </h3>

                <?php echo $subNotFound; ?>

            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/layouts/sortable.blade.php ENDPATH**/ ?>