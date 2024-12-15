<?php
	$uri = $_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Gerência de Reservas</title>

    <!-- styles -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
	<?php

		echo $this->Html->css('fontawesome');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('style');
	?>
</head>
<body>
	<div class="container p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center" style="width: 100%;">
			<?php
				echo $this->Html->link(
					'Espacos',
					array('controller' => 'espacos', 'action' => 'index'),
					strpos($uri, 'espacos') !== false ? array('class' => 'nav-link link-active') : array('class' => 'nav-link')
				);
			?>
			<?php
				echo $this->Html->link(
					'Reservas',
					array('controller' => 'reservas', 'action' => 'index'),
					strpos($uri, 'reservas') !== false ? array('class' => 'nav-link link-active') : array('class' => 'nav-link')
				);
			?>
        </nav>
    </div>

    <main class="container p-0">
		<?php
			echo $this->fetch('content');
		?>
    </main>

	<?php echo $this->Html->script('jquery'); ?>
	<?php echo $this->Html->script('fontawesome'); ?>
	<?php echo $this->Html->script('bootstrap'); ?>
	<?php echo $this->Html->script('jquery.mask.min.js'); ?>
	<script>
		$(document).ready(function() {
			$('.cpf').mask('000.000.000-00')
			$('.telefone').mask('(00) 00000-0000')
		});
	</script>
</body>
</html>
