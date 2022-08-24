

<?php $__env->startSection('center_content'); ?>
    <div class="pl-4 pt-4">
        <a href="/" class="btn btn-danger"><?php echo e(__('Назад')); ?></a>
    </div>
    <?php if($application->user_id == auth()->user()->id): ?>
    <?php echo e(Aire::open()
  ->route('site.applications.is_more_than_limit',$application->id)
  ->enctype("multipart/form-data")
  ->post()); ?>

    <div class="container">
        <?php if($application->is_more_than_limit == 1): ?>
        <?php echo e(Aire::submit(__("Company"))
        ->variant()->green()
        ->name('is_more_than_limit')
        ->value('1')); ?>

        <?php else: ?>
            <?php echo e(Aire::submit(__("Company"))
        ->variant()->gray()
        ->name('is_more_than_limit')
        ->value('1')); ?>

        <?php endif; ?>
        <?php if($application->is_more_than_limit == '0'): ?>
        <?php echo e(Aire::submit(__("Filial"))
        ->variant()->green()
        ->name('is_more_than_limit')
        ->value('0')); ?>

            <?php else: ?>
            <?php echo e(Aire::submit(__("Filial"))
        ->variant()->gray()
        ->name('is_more_than_limit')
        ->value('0')); ?>

            <?php endif; ?>
    </div>
    <?php echo e(Aire::close()); ?>

    <?php endif; ?>
    <?php echo e(Aire::open()
    ->route('site.applications.update',$application->id)
    ->enctype("multipart/form-data")
    ->post()); ?>

    <?php echo $__env->renderWhen($application->user_id == auth()->user()->id,'site.applications.form_edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo $__env->renderWhen($user->hasPermission('Branch_Performer') && $application->user_id != $user->id || $user->hasPermission('Company_Performer') && $application->user_id != $user->id || $application->performer_role_id == $user->role_id ,'site.applications.performer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo $__env->renderWhen($user->hasPermission('Warehouse') && $application->status == 'Принята','site.applications.warehouse', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo e(Aire::close()); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/applications/edit.blade.php ENDPATH**/ ?>