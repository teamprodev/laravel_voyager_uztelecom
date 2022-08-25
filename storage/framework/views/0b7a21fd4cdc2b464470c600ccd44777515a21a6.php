<?php echo e(Aire::textArea('bio', __('Номер заявки'))
                    ->name('number')
                    ->value($application->number)); ?>

<div class="mb-3 row w-50">
    <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">
        <?php echo e(__('Дата заявки')); ?>

    </label>
    <div class="col-sm-6">
        <input class="form-control" id="date" name="date" type="date" value="<?php echo e($application->date); ?>"/>
    </div>
</div>
<?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/components/number_change.blade.php ENDPATH**/ ?>