<div class="row g-3 mb-3">
    <div class="col-md-3">
        <div class="card bg-primary bg-gradient text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0"><?php echo e($products_count); ?></h2>
                        <small>Total Products</small>
                    </div>
                    <div>
                        <i class="bi bi-box-seam" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning bg-gradient text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0"><?php echo e($featured_products); ?></h2>
                        <small>Featured</small>
                    </div>
                    <div>
                        <i class="bi bi-star-fill" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info bg-gradient text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="mb-0 small">Created</div>
                        <small><?php echo e($created_at->format('M d, Y')); ?></small>
                    </div>
                    <div>
                        <i class="bi bi-calendar-plus" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-secondary bg-gradient text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="mb-0 small">Updated</div>
                        <small><?php echo e($updated_at->diffForHumans()); ?></small>
                    </div>
                    <div>
                        <i class="bi bi-clock-history" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/orchid/category-stats.blade.php ENDPATH**/ ?>