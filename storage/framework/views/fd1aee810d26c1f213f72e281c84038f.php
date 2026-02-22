<button formaction="<?php echo e(url()->current()); ?>/<?php echo e($notification->id); ?>/maskNotification"
        type="submit"
        class="btn btn-link text-start p-4 d-flex align-items-baseline">

    <small class="align-self-start me-2 text-<?php echo e($notification->data['type']); ?> <?php if($notification->read()): ?> opacity <?php endif; ?>">
        <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.circle-fill'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    </small>

    <span class="ps-3 text-wrap text-break">
        <span class="w-100"><?php echo e($notification->data['title'] ?? ''); ?></span>
        <small class="text-muted ps-1 d-inline d-md-none">/ <?php echo e($notification->created_at->diffForHumans()); ?></small>
        <br>
        <small class="text-muted w-100">
            <?php echo $notification->data['message'] ?? ''; ?>

        </small>
    </span>

    <small class="text-muted col-3 ms-auto d-none d-md-block text-end">
         <?php echo e($notification->created_at->diffForHumans()); ?>

    </small>
</button>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/partials/notification.blade.php ENDPATH**/ ?>