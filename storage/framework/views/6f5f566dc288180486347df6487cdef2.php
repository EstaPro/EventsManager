<div class="row g-3">
    <?php $__currentLoopData = $manyForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'col-md',
            $columnClass[0] .' order-md-first' => $loop->index % 2 == 0,
            $columnClass[1] . ' order-md-last' => $loop->index % 2 != 0,
            'order-first' => $reverseOnPhone && $loop->index % 2 != 0
        ]); ?>">
            <?php $__currentLoopData = $column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $item ?? ''; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/vendor/platform/layouts/split.blade.php ENDPATH**/ ?>