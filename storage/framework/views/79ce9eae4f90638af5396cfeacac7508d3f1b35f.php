<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<div <?php echo e($attributes); ?>>
	<?php echo e($label); ?>

	
	<div class="<?php echo e($prepend || $append ? 'flex' : ''); ?>">
		<?php if($prepend): ?>
			<div <?php echo e($attributes->prepend); ?>>
				<?php echo e($prepend); ?>

			</div>
		<?php endif; ?>
		
		<?php echo e($element); ?>

			
		<?php if($append): ?>
			<div <?php echo e($attributes->append); ?>>
				<?php echo e($append); ?>

			</div>
		<?php endif; ?>
	</div>
	
	<ul <?php echo e($attributes->errors); ?>>
		<?php echo $__env->renderEach($error_view, $errors, 'error'); ?>
	</ul>
	
	<?php if(isset($help_text)): ?>
		<small <?php echo e($attributes->help_text); ?>>
			<?php echo e($help_text); ?>

		</small>
	<?php endif; ?>
	
</div>
<?php /**PATH D:\Develop\Panels\OpenServer\domains\laravel_voyager_uztelecom\vendor\glhd\aire/views/group.blade.php ENDPATH**/ ?>