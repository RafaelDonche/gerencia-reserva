<div class="container d-flex justify-content-center align-items-center min-vh-100">
	<div class="card" style="width: 100%; max-width: 400px;">
		<div class="card-body">
			<h2 class="card-title text-center mb-4">Login</h2>

			<!-- Exibe a mensagem de erro, se houver -->
			<?php if ($this->Session->check('auth')): ?>
				<div class="alert alert-danger">
					<?php echo $this->Session->flash('auth'); ?>
				</div>
			<?php endif; ?>

			<!-- Formulário de Login -->
			<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'), 'novalidate' => true)); ?>
				<div class="form-group">
					<?php
						echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Digite seu nome de usuário', 'label' => 'Nome'));
					?>
				</div>

				<div class="form-group">
					<?php
						echo $this->Form->input(
							'password',
							array(
								'type' => 'password',
								'class' => 'form-control',
								'placeholder' => 'Digite sua senha',
								'label' => 'Senha'
							)
						);
					?>
				</div>

				<div class="form-group text-center">
					<?php echo $this->Form->button('Entrar', array('class' => 'btn btn-primary btn-block')); ?>
				</div>

			<?php echo $this->Form->end(); ?>

			<!-- <div class="text-center mt-3">
				<small>Ainda não tem uma conta? <a href="/users/register">Cadastre-se aqui</a></small>
			</div> -->
		</div>
	</div>
</div>
