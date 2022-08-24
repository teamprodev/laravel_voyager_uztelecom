<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<textarea <?php echo e($attributes->except('value')); ?>><?php echo e($attributes->get('value')); ?></textarea>

<?php if(isset($auto_size) && $auto_size && $attributes->has('id')): ?>
	<script>
	(function(s, h) {
		try {
			var e = document.getElementById('<?php echo e($attributes->get('id')); ?>'),
				o = e.offsetHeight - e.clientHeight,
				a = function() {
					e[s][h] = 'auto';
					e[s][h] = e.scrollHeight + o + 'px';
				};
			e.addEventListener('input', a);
			setTimeout(a, 10);
		} catch (e) {
		}
	})('style', 'height');
	</script>
<?php endif; ?>
<?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\vendor\glhd\aire/views/textarea.blade.php ENDPATH**/ ?>