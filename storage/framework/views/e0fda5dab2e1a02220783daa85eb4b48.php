<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="card bg-primary bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['total']); ?></h3>
                        <small>Total Meetings</small>
                    </div>
                    <div>
                        <i class="bi bi-calendar3" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card bg-warning bg-gradient text-dark h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['pending']); ?></h3>
                        <small>Pending</small>
                    </div>
                    <div>
                        <i class="bi bi-clock-history" style="font-size: 2rem; opacity: 0.5;"></i>
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
                        <h3 class="mb-0"><?php echo e($stats['confirmed']); ?></h3>
                        <small>Confirmed</small>
                    </div>
                    <div>
                        <i class="bi bi-check-circle" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card bg-danger bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['cancelled']); ?></h3>
                        <small>Cancelled</small>
                    </div>
                    <div>
                        <i class="bi bi-x-circle" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-info bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0"><?php echo e($stats['today']); ?></h3>
                        <small>Today's Meetings</small>
                    </div>
                    <div>
                        <i class="bi bi-calendar-event" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/admin/appointment/stats.blade.php ENDPATH**/ ?>