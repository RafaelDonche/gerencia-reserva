
<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">
			<?php echo $this->Html->link(
				'Voltar',
				array('controller' => 'reservas', 'action' => 'index'),
				array('class' => 'btn btn-secondary btn-pill float-start')
			)?>
            Edição da reserva
        </h2>
    </div>
    <div class="card-body">

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->Form->create('Reserva',  array('url' => array('controller' => 'reservas', 'action' => 'edit', $reserva['Reserva']['id']))); ?>
		<div class="row">
			<?php
				echo $this->Form->input('cliente_nome', array(
					'div' => array('class' => 'col-md-6 mb-3'),
					// 'label' => 'Nome do cliente',
					'label' => array('class' => 'form-label', 'text' => 'Nome do cliente'),
					'class' => 'form-control'
				));
				echo $this->Form->input('cliente_cpf', array(
					'div' => array('class' => 'col-md-6 mb-3'),
					'label' => array('class' => 'form-label', 'text' => 'CPF do cliente'),
					'class' => 'form-control cpf'
				));
			?>
			<div class="col-md-4 mb-3">
				<label class="form-label" for="ReservaEspacoId">Espaço</label>
				<select class="form-control" name="data[Reserva][espaco_id]">
					<?php
						foreach ($espacos as $id => $endereco) {
							if ($id == $this->request->data['Reserva']['espaco_id']) {
								echo '<option value="'.$id.'" selecetd>'.$endereco.'</option>';
							}else {

								echo '<option value="'.$id.'">'.$endereco.'</option>';
							}
						}
					?>
				</select>
			</div>
			<div class="col-md-4 mb-3">
				<label class="form-label" for="ReservaInicio">Início da reserva</label>
				<input class="form-control" type="datetime-local" name="data[Reserva][inicio]" value="<?php echo $this->request->data['Reserva']['inicio'] ?>">
			</div>
			<div class="col-md-4 mb-3">
				<label class="form-label" for="ReservaFim">Fim da reserva</label>
				<input class="form-control" type="datetime-local" name="data[Reserva][fim]" value="<?php echo $this->request->data['Reserva']['fim'] ?>">
			</div>
			<?php
				echo $this->Form->input('recepcao', array(
					'div' => array('class' => 'col-md-6 mb-3'),
					'label' => array('class' => 'form-label', 'text' => 'Quantidade de recepcionistas'),
					'class' => 'form-control'
				));
				echo $this->Form->input('coffe_break', array(
						'type' => 'select',
						'options' => array(
							'' => 'Nenhum',
							'Tradicional' => 'Tradicional',
							'Premium' => 'Premium'
						),
						'label' => array('class' => 'form-label', 'text' => 'Coffe-break'),
						'div' => array('class' => 'col-md-6 mb-3'),
						'class' => 'form-control'
					)
				);
				echo $this->Form->input('Adicional.Adicional', [
					'type' => 'select',
					'multiple' => 'checkbox',
					'label' => 'Estruturas adicionais',
					'options' => $estruturas,
					'div' => array('class' => 'col-md-12 mb-3'),
					'class' => 'checkbox mx-3'
				]);
				echo $this->Form->end(array(
					'label' => 'Salvar',
					'div' => array('class' => 'col-md-12'),
					'class' => 'btn btn-primary'
				));
			?>
		</div>
    </div>
</div>
