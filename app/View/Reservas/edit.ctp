
<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">
			<?php echo $this->Html->link(
				'Voltar',
				array('controller' => 'espacos', 'action' => 'index'),
				array('class' => 'btn btn-secondary btn-pill float-start')
			)?>
            Edição do espaço
        </h2>
    </div>
    <div class="card-body">

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->Form->create('Espaco',  array('url' => array('controller' => 'espacos', 'action' => 'edit'))); ?>
		<div class="row">
			<?php
				echo $this->Form->input('endereco', array(
					'div' => array('class' => 'col-md-6 mb-3'),
					'label' => array('class' => 'form-label'),
					'class' => 'form-control',
					'error' => array(
						'attributes' => array('wrap' => 'div', 'class' => 'invalid-feedback')
					)
				));
				echo $this->Form->input('telefone', array(
					'div' => array('class' => 'col-md-6 mb-3'),
					'label' => array('class' => 'form-label'),
					'class' => 'form-control telefone'
				));
				echo $this->Form->input('lotacao', array(
					'div' => array('class' => 'col-md-4 mb-3'),
					'label' => array('class' => 'form-label', 'title' => 'Limite de participantes'),
					'class' => 'form-control',
					'type' => 'number',
					'error' => array(
						'attributes' => array('wrap' => 'div', 'class' => 'invalid-feedback')
					)
				));
			?>
			<div class="col-md-4 mb-3">
				<label class="form-label" for="EspacoHora_inicio">Inicio do horário de funcionamento</label>
				<input class="form-control" type="time" name="data[Espaco][hora_inicio]" value="<?php echo $this->request->data['Espaco']['hora_inicio'] ?>">
			</div>
			<div class="col-md-4 mb-3">
				<label class="form-label" for="EspacoHora_fim">Fim do horário de funcionamento</label>
				<input class="form-control" type="time" name="data[Espaco][hora_fim]" value="<?php echo $this->request->data['Espaco']['hora_fim'] ?>">
			</div>
			<?php
				echo $this->Form->end(array(
					'label' => 'Salvar',
					'div' => array('class' => 'col-md-12'),
					'class' => 'btn btn-primary'
				));
			?>
		</div>
    </div>
</div>
