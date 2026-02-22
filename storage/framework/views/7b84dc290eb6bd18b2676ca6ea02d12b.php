<div id="accordion-<?php echo e($templateSlug); ?>" class="accordion mb-3">
    <?php $__currentLoopData = $manyForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $forms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $collapseId = 'collapse-' . \Illuminate\Support\Str::slug($name);
            $collapseIsOpen = in_array($name, $open);
        ?>

        <a
            href="#<?php echo e($collapseId); ?>"
            data-bs-target="#<?php echo e($collapseId); ?>"
            class="accordion-heading nav-link py-2 px-1 d-flex align-items-center"
            data-bs-toggle="collapse"
            aria-expanded="<?php echo e($collapseIsOpen ? 'true' : 'false'); ?>"
            role="button"
            aria-controls="<?php echo e($collapseId); ?>"
        >
            <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.chevron-right','class' => 'small me-2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <?php echo $name; ?>

        </a>

        <div
            id="<?php echo e($collapseId); ?>"
            class="mt-2 collapse <?php if($collapseIsOpen): ?> show <?php endif; ?>"
            <?php if(! $stayOpen): ?>
                data-bs-parent="#accordion-<?php echo e($templateSlug); ?>"
            <?php endif; ?>
        >
            <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $form; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/layouts/accordion.blade.php ENDPATH**/ ?>