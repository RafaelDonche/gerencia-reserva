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

<?php
	echo $this->fetch('content');
?>

<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Html->script('fontawesome'); ?>
<?php echo $this->Html->script('bootstrap'); ?>
</body>
</html>
