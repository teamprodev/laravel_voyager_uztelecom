<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<form <?php echo e($attributes); ?>>

	<?php if(isset($_token) && 'GET' !== $method): ?>
		<input type="hidden" name="_token" value="<?php echo e($_token); ?>" hidden />
	<?php endif; ?>
	
	<?php if(isset($_method)): ?>
		<input type="hidden" name="_method" value="<?php echo e($_method); ?>" hidden />
	<?php endif; ?>
	
	<?php echo e($fields); ?>

	
	<?php echo e($validation); ?>

	
</form>
<?php /**PATH D:\ArabicDev\Projects\Uztelecom\laravel_voyager_uztelecom\vendor\glhd\aire/views/form.blade.php ENDPATH**/ ?>