<?php $__env->startSection('body'); ?>

    <div class="container-md">
        <div class="form-signin h-full min-vh-100 d-flex flex-column justify-content-center">

            <a class="d-flex justify-content-center mb-4 p-0 px-sm-5" href="<?php echo e(Dashboard::prefix()); ?>">
                <?php echo $__env->first([config('platform.template.header'), 'platform::header'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </a>

            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xxl-5 px-md-5">

                    <div class="bg-white p-4 p-sm-5 rounded shadow-sm">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>


            <?php echo $__env->first([config('platform.template.footer'), 'platform::footer'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('platform::app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/auth.blade.php ENDPATH**/ ?>