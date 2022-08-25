<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>
<?php /** @var \Galahad\Aire\Support\OptionsCollection $options */ ?>

<div <?php echo e($attributes->wrapper); ?>>
	
	<?php if(isset($prepend_empty_option)): ?>
		<label <?php echo e($attributes->label); ?>>
			<input
					<?php echo e($attributes->except('id', 'value', 'checked')); ?>

					value="<?php echo e($prepend_empty_option->value); ?>"
					<?php echo e($attributes->isValue($prepend_empty_option->value) ? 'checked' : ''); ?>

			/>
			<span <?php echo e($attributes->label_wrapper); ?>>
				<?php echo e($prepend_empty_option->label); ?>

			</span>
		</label>
	<?php endif; ?>
	
	<?php $__currentLoopData = $options->getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option_value => $option_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		
		<label <?php echo e($attributes->label); ?>>
			<input
				<?php echo e($attributes->except('id', 'value', 'checked')); ?>

				value="<?php echo e($option_value); ?>"
				<?php echo e($attributes->isValue($option_value) ? 'checked' : ''); ?>

			/>
			<span <?php echo e($attributes->label_wrapper); ?>>
				<?php echo e($option_label); ?>

			</span>
		</label>
	
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\vendor\glhd\aire/views/checkbox-group.blade.php ENDPATH**/ ?>