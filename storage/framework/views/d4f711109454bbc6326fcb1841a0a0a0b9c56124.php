<ul class="flex flex-row mt-2">
    <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="mx-1">
            <a class="hover:text-red-500" rel="alternate" hreflang="<?php echo e($localeCode); ?>" href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
                <?php echo e($properties['native']); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH D:\ArabicDev\Projects\Uztelecom\laravel_voyager_uztelecom\resources\views/site/dashboard/language.blade.php ENDPATH**/ ?>