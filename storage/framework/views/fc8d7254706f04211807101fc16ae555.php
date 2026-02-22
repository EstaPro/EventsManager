<div class="card mb-4 bg-gradient" style="background: linear-gradient(135deg, <?php echo e($preview['primary_color'] ?? '#D4AF37'); ?> 0%, <?php echo e($preview['secondary_color'] ?? '#0F172A'); ?> 100%);">
    <div class="card-body text-white">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="mb-3">
                    <i class="bi bi-phone"></i> Mobile App Preview
                </h4>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <?php if($preview['logo']): ?>
                        <img src="<?php echo e($preview['logo']); ?>" alt="Logo" class="rounded" style="width: 60px; height: 60px; object-fit: contain; background: white; padding: 8px;">
                    <?php else: ?>
                        <div class="bg-white text-dark rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-image" style="font-size: 24px;"></i>
                        </div>
                    <?php endif; ?>
                    <div>
                        <h5 class="mb-0"><?php echo e($preview['event_name']); ?></h5>
                        <small class="opacity-75">Your event name will appear here</small>
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <div class="badge" style="background-color: <?php echo e($preview['primary_color']); ?>; color: white;">
                        Primary Color
                    </div>
                    <div class="badge" style="background-color: <?php echo e($preview['secondary_color']); ?>; color: white;">
                        Secondary Color
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="phone-mockup mx-auto" style="width: 200px; height: 350px; background: white; border-radius: 30px; padding: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                    <div class="screen" style="background: <?php echo e($preview['secondary_color']); ?>; height: 100%; border-radius: 20px; padding: 15px; color: white;">
                        <div class="status-bar mb-3 d-flex justify-content-between small opacity-75">
                            <span>9:41</span>
                            <span><i class="bi bi-wifi"></i> <i class="bi bi-battery-full"></i></span>
                        </div>
                        <div class="app-header mb-3 text-center">
                            <?php if($preview['logo']): ?>
                                <img src="<?php echo e($preview['logo']); ?>" alt="Logo" style="width: 40px; height: 40px; margin-bottom: 10px;">
                            <?php endif; ?>
                            <div class="small fw-bold"><?php echo e(Str::limit($preview['event_name'], 20)); ?></div>
                        </div>
                        <div class="menu-items">
                            <div class="p-2 rounded mb-2" style="background: <?php echo e($preview['primary_color']); ?>;">
                                <i class="bi bi-house-door"></i> Home
                            </div>
                            <div class="p-2 rounded mb-2 opacity-75" style="background: rgba(255,255,255,0.1);">
                                <i class="bi bi-calendar-event"></i> Agenda
                            </div>
                            <div class="p-2 rounded mb-2 opacity-75" style="background: rgba(255,255,255,0.1);">
                                <i class="bi bi-building"></i> Exhibitors
                            </div>
                            <div class="p-2 rounded opacity-75" style="background: rgba(255,255,255,0.1);">
                                <i class="bi bi-chat"></i> Messages
                            </div>
                        </div>
                    </div>
                </div>
                <p class="small mt-2 mb-0 opacity-75">Live preview updates as you edit</p>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/admin/event/app-preview.blade.php ENDPATH**/ ?>