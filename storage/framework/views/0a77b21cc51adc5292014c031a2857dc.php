<div class="p-4 border rounded bg-light">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">📱 Preview</h6>
                </div>
                <div class="card-body text-center">
                    <?php if($widgetType === 'menu_grid'): ?>
                        <div class="d-flex flex-column align-items-center p-4">
                            <?php if($item->icon): ?>
                                <div class="bg-primary rounded-circle p-3 mb-3 shadow-sm">
                                    <i class="material-icons text-white" style="font-size: 36px;">
                                        <?php echo e($item->icon); ?>

                                    </i>
                                </div>
                            <?php else: ?>
                                <div class="bg-light rounded-circle p-3 mb-3 border">
                                    <i class="material-icons text-muted" style="font-size: 36px;">
                                        help_outline
                                    </i>
                                </div>
                            <?php endif; ?>
                            <?php if($item->title): ?>
                                <h6 class="fw-bold mb-2"><?php echo e($item->title); ?></h6>
                            <?php endif; ?>
                            <?php if($item->subtitle): ?>
                                <small class="text-muted"><?php echo e($item->subtitle); ?></small>
                            <?php endif; ?>
                        </div>
                    <?php elseif($widgetType === 'slider'): ?>
                        <div class="border rounded overflow-hidden shadow-sm">
                            <?php if($item->image): ?>
                                <div class="bg-light" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                                    <div class="text-center">
                                        <i class="bs.image text-muted" style="font-size: 48px;"></i>
                                        <div class="mt-2 text-muted small">Image preview</div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="bg-warning bg-opacity-10" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                                    <div class="text-center">
                                        <i class="bs.image text-warning" style="font-size: 48px;"></i>
                                        <div class="mt-2 text-warning">Image required</div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="p-3">
                                <?php if($item->title): ?>
                                    <h6 class="fw-bold mb-2"><?php echo e($item->title); ?></h6>
                                <?php endif; ?>
                                <?php if($item->subtitle): ?>
                                    <p class="small text-muted mb-0"><?php echo e($item->subtitle); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php elseif($widgetType === 'logo_cloud'): ?>
                        <div class="d-flex align-items-center justify-content-center p-4" style="height: 200px;">
                            <?php if($item->image): ?>
                                <div class="bg-white p-4 rounded border shadow-sm" style="max-width: 150px;">
                                    <div class="text-center">
                                        <i class="bs.building text-primary" style="font-size: 36px;"></i>
                                        <div class="mt-2 fw-bold small">Logo</div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="bg-warning bg-opacity-10 p-4 rounded border" style="max-width: 150px;">
                                    <div class="text-center text-warning">
                                        <i class="bs.building" style="font-size: 36px;"></i>
                                        <div class="mt-2 fw-bold">Logo required</div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($item->title): ?>
                                <div class="ms-4">
                                    <div class="fw-bold"><?php echo e($item->title); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="d-flex align-items-start p-4">
                            <?php if($item->icon): ?>
                                <div class="me-3">
                                    <i class="material-icons text-primary" style="font-size: 32px;"><?php echo e($item->icon); ?></i>
                                </div>
                            <?php endif; ?>
                            <div class="flex-grow-1">
                                <?php if($item->title): ?>
                                    <h6 class="fw-bold mb-2"><?php echo e($item->title); ?></h6>
                                <?php endif; ?>
                                <?php if($item->subtitle): ?>
                                    <p class="text-muted mb-3"><?php echo e($item->subtitle); ?></p>
                                <?php endif; ?>
                                <?php if($item->action_url): ?>
                                    <div class="d-flex align-items-center">
                                        <i class="bs.link-45deg text-primary me-2"></i>
                                        <small class="text-truncate"><?php echo e($item->action_url); ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">📊 Details</h6>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Widget Type:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-info text-capitalize">
                                <?php echo e(str_replace('_', ' ', $widgetType)); ?>

                            </span>
                        </dd>

                        <dt class="col-sm-5">Icon Status:</dt>
                        <dd class="col-sm-7">
                            <?php if($item->icon): ?>
                                <span class="badge bg-success">
                                    <i class="material-icons me-1" style="font-size: 14px;"><?php echo e($item->icon); ?></i>
                                    <?php echo e($item->icon); ?>

                                </span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Not set</span>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-5">Image Status:</dt>
                        <dd class="col-sm-7">
                            <?php if($item->image): ?>
                                <span class="badge bg-success">✓ Uploaded</span>
                            <?php else: ?>
                                <?php if(in_array($widgetType, ['slider', 'logo_cloud', 'single_banner'])): ?>
                                    <span class="badge bg-danger">⚠ Required</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Optional</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-5">Link URL:</dt>
                        <dd class="col-sm-7">
                            <?php if($item->action_url): ?>
                                <div class="text-truncate" style="max-width: 150px;" title="<?php echo e($item->action_url); ?>">
                                    <i class="bs.link-45deg text-primary me-1"></i>
                                    <?php echo e($item->action_url); ?>

                                </div>
                            <?php else: ?>
                                <span class="badge bg-secondary">No link</span>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-5">Display Order:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-dark">#<?php echo e($item->order ?? '0'); ?></span>
                        </dd>

                        <dt class="col-sm-5">Section:</dt>
                        <dd class="col-sm-7">
                            <span class="fw-bold"><?php echo e($widget->title ?? 'Unknown'); ?></span>
                        </dd>
                    </dl>

                    <?php
                        $requirements = [
                            'slider' => ['image'],
                            'menu_grid' => ['icon'],
                            'logo_cloud' => ['image'],
                            'single_banner' => ['image'],
                        ];

                        $req = $requirements[$widgetType] ?? [];
                        $missing = [];

                        foreach ($req as $field) {
                            if (empty($item->$field)) {
                                $missing[] = $field;
                            }
                        }
                    ?>

                    <?php if(!empty($missing)): ?>
                        <div class="alert alert-warning mt-3 mb-0">
                            <div class="d-flex">
                                <i class="bs.exclamation-triangle me-2"></i>
                                <div>
                                    <strong>Requirements missing:</strong>
                                    <ul class="mb-0 mt-1">
                                        <?php $__currentLoopData = $missing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e(ucfirst($field)); ?> is required for <?php echo e($widgetType); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/orchid/item-preview.blade.php ENDPATH**/ ?>