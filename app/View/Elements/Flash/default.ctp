<!-- <div id="<?php echo $key; ?>Message" class="<?php echo !empty($params['class']) ? $params['class'] : 'message'; ?>"><?php echo $message; ?></div> -->

<div class="alert alert-secondary alert-dismissible fade show" role="alert">
	<div class="alert-message">
		<?php echo $message; ?>
	</div>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
