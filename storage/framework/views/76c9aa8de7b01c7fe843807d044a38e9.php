<div class="d-block bg-white rounded shadow-sm mb-3">
    <div class="row g-0">

            <?php if(empty(!$image)): ?>
                <div class="col-md-4">
                    <div class="h-100" style="display: contents">
                        <img src="<?php echo e($image); ?>" class="img-fluid img-card">
                    </div>
                </div>
            <?php endif; ?>

            <div class="col">
                <div class="card-body h-full p-4">
                    <div class="row d-flex align-items-center">
                        <div class="col-auto">
                            <h5 class="card-title">
                                <?php if(empty(!$color)): ?><i class="text-<?php echo e($color); ?>">●</i><?php endif; ?>
                                <?php echo e($title ?? ''); ?>

                            </h5>
                        </div>

                        <?php if(count($commandBar) > 0): ?>
                            <div class="col-auto ms-auto text-end">
                                <div class="btn-group command-bar">
                                    <button class="btn btn-link btn-sm dropdown-toggle dropdown-item p-2" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'options-vertical'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow bg-white"
                                         x-placement="bottom-end">
                                        <?php $__currentLoopData = $commandBar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo $command; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-text layout-wrapper layout-wrapper-no-padder"><?php echo $description ?? ''; ?></div>
                </div>
            </div>

        </div>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/layouts/card.blade.php ENDPATH**/ ?>