<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="card bg-primary bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['total']); ?></h3>
                        <small>Total Users</small>
                    </div>
                    <div>
                        <i class="bi bi-people" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card bg-info bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['exhibitors']); ?></h3>
                        <small>Exhibitors</small>
                    </div>
                    <div>
                        <i class="bi bi-building" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card bg-success bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['visitors']); ?></h3>
                        <small>Visitors</small>
                    </div>
                    <div>
                        <i class="bi bi-person" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning bg-gradient text-dark h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['with_company']); ?></h3>
                        <small>With Company</small>
                    </div>
                    <div>
                        <i class="bi bi-briefcase" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-secondary bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['visible']); ?></h3>
                        <small>Visible in Directory</small>
                    </div>
                    <div>
                        <i class="bi bi-eye" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/orchid/users/stats.blade.php ENDPATH**/ ?>