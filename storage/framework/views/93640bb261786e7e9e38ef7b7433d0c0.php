<div class="bg-white rounded shadow-sm p-4 mb-3">

    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
            <div class="avatar bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 40px; height: 40px;">
                <?php echo e(substr($user1->name, 0, 1)); ?>

            </div>
            <div>
                <h5 class="mb-0 text-dark"><?php echo e($user1->name); ?></h5>
                <small class="text-muted"><?php echo e($user1->email); ?></small>
            </div>
        </div>

        <div class="text-muted small px-3">
            <i class="icon-refresh"></i> Interaction
        </div>

        <div class="d-flex align-items-center text-end">
            <div>
                <h5 class="mb-0 text-dark"><?php echo e($user2->name); ?></h5>
                <small class="text-muted"><?php echo e($user2->email); ?></small>
            </div>
            <div class="avatar bg-success text-white rounded-circle d-flex justify-content-center align-items-center ms-2" style="width: 40px; height: 40px;">
                <?php echo e(substr($user2->name, 0, 1)); ?>

            </div>
        </div>
    </div>

    <div class="chat-history" style="max-height: 600px; overflow-y: auto; background-color: #f8f9fa; padding: 20px; border-radius: 8px;">
        <?php if($messages->isEmpty()): ?>
            <div class="text-center text-muted py-5">
                <i class="icon-bubble display-4 mb-3 d-block"></i>
                No messages exchanged between these users yet.
            </div>
        <?php else: ?>
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isUser1 = $msg->sender_id == $user1->id;
                    $alignment = $isUser1 ? 'start' : 'end';
                    $bgColor = $isUser1 ? 'bg-white border' : 'bg-primary text-white';
                    $textColor = $isUser1 ? 'text-dark' : 'text-white';
                    $metaColor = $isUser1 ? 'text-muted' : 'text-white-50';
                    $senderName = $isUser1 ? $user1->name : $user2->name;
                ?>

                <div class="d-flex justify-content-<?php echo e($alignment); ?> mb-3">
                    <div class="d-flex flex-column align-items-<?php echo e($alignment); ?>" style="max-width: 70%;">

                        <small class="text-muted mb-1" style="font-size: 0.75rem;">
                            <?php echo e($senderName); ?> • <?php echo e($msg->created_at->format('M d, H:i')); ?>

                        </small>

                        <div class="p-3 rounded shadow-sm <?php echo e($bgColor); ?> <?php echo e($textColor); ?>" style="position: relative;">

                            <?php if($msg->content): ?>
                                <p class="mb-1" style="white-space: pre-wrap;"><?php echo e($msg->content); ?></p>
                            <?php endif; ?>

                            <?php if($msg->attachment_url): ?>
                                <div class="mt-2 pt-2 border-top border-light">
                                    <a href="<?php echo e($msg->attachment_url); ?>" target="_blank" class="<?php echo e($isUser1 ? 'text-primary' : 'text-white'); ?> text-decoration-none d-flex align-items-center">
                                        <i class="icon-paper-clip me-1"></i> View Attachment
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/admin/conversation.blade.php ENDPATH**/ ?>