<div
    class="mb-3"
    data-controller="tabs"
    data-tabs-slug="<?php echo e($templateSlug); ?>"
    data-tabs-active-tab="<?php echo e($activeTab); ?>"
>
    <nav class="d-flex justify-content-center text-nowrap mb-3">
        <div class="bg-body-tertiary rounded overflow-hidden">
            <ul class="nav nav-pills nav-justified d-inline-flex mx-auto px-3 py-2 nav-scroll-bar gap-2" role="tablist">
                <?php $__currentLoopData = $manyForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item" role="presentation">
                        <a
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'nav-link',
                                'active' => $activeTab === $name || ($loop->first && is_null($activeTab))
                            ]); ?>"
                            data-action="tabs#setActiveTab"
                            href="#tab-<?php echo e(sha1($templateSlug.$name)); ?>"
                            data-bs-target="#tab-<?php echo e(sha1($templateSlug.$name)); ?>"
                            id="button-tab-<?php echo e(sha1($templateSlug.$name)); ?>"
                            aria-selected="false"
                            role="tab"
                            data-bs-toggle="tab">
                            <?php echo $name; ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </nav>


    <section class="tab-content">
        <?php $__currentLoopData = $manyForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $forms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div role="tabpanel"
                 id="tab-<?php echo e(sha1($templateSlug.$name)); ?>"
                 class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'tab-pane',
                    'active' => $activeTab === $name || ($loop->first && is_null($activeTab))
                 ]); ?>"
            >
                <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $form; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/vendor/orchid/platform/resources/views/layouts/tabs.blade.php ENDPATH**/ ?>