<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>
<?php /** @var \Galahad\Aire\Support\OptionsCollection $options */ ?>

<select <?php echo e($attributes->except('value')); ?>>
	
	<?php if(isset($prepend_empty_option)): ?>
		<option value="<?php echo e($prepend_empty_option->value); ?>" <?php echo e($attributes->isValue($prepend_empty_option->value) ? 'selected' : ''); ?>>
			<?php echo e($prepend_empty_option->label); ?>

		</option>
	<?php endif; ?>
	
	<?php $__currentLoopData = $options->getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		
		<?php if(is_array($label)): ?>
			
			<optgroup label="<?php echo e($value); ?>">
				
				<?php $__currentLoopData = $label; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $nestedLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($value); ?>" <?php echo e($attributes->isValue($value) ? 'selected' : ''); ?>>
						<?php echo e($nestedLabel); ?>

					</option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			</optgroup>
		
		<?php else: ?>
			
			<option value="<?php echo e($value); ?>" <?php echo e($attributes->isValue($value) ? 'selected' : ''); ?>>
				<?php echo e($label); ?>

			</option>
		
		<?php endif; ?>
	
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>
<?php /**PATH D:\ArabicDev\Projects\Uztelecom\Project\laravel_voyager_uztelecom\vendor\glhd\aire/views/select.blade.php ENDPATH**/ ?>