<div class="card">

    <div class="card-hearder">
        <h2 class="text-title">Gerencie os espaços</h2>
    </div>

    <div class="card-body mb-3">

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->Form->create('Espaco',  array('url' => array('controller' => 'espacos', 'action' => 'add'))); ?>
		<div class="row">
			<div class="col-md-12">
				<h4>Adicionar um novo espaço</h4>
				<hr class="mt-0">
			</div>
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
				<input class="form-control" type="time" name="data[Espaco][hora_inicio]">
			</div>
			<div class="col-md-4 mb-3">
				<label class="form-label" for="EspacoHora_fim">Fim do horário de funcionamento</label>
				<input class="form-control" type="time" name="data[Espaco][hora_fim]">
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

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Listagem de espaços cadastrados</h4>
                <hr class="mt-0">
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th>Endereço</th>
								<th>Telefone</th>
								<th>Lotação máxima</th>
								<th>Horário de <br> funcionamento</th>
								<th>Ações</th>
							</tr>
						</thead>

						<tbody>
						<?php foreach ($espacos as $espaco): ?>
							<tr>
								<td>
									<!-- <?php echo $this->Html->link($espaco['Espaco']['endereco'], array('controller' => 'espacos', 'action' => 'view', $espaco['Espaco']['id'])); ?> -->
									<?php echo $espaco['Espaco']['endereco']; ?>
								</td>
								<td>
									<?php
										if (strlen($espaco['Espaco']['telefone']) == 11) {
											echo preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $espaco['Espaco']['telefone']);
										}else {
											echo $espaco['Espaco']['telefone'];
										}
									?>
								</td>
								<td><?php echo $espaco['Espaco']['lotacao']; ?></td>
								<td>
									Início: <?php echo date('H:i', strtotime($espaco['Espaco']['hora_inicio'])); ?> <br>
									Fim: <?php echo date('H:i', strtotime($espaco['Espaco']['hora_fim'])); ?>
								</td>
								<td>
									<?php
										echo $this->Html->link(
											'Editar',
											array('action' => 'edit', $espaco['Espaco']['id']),
											array('class' => 'btn btn-secondary m-1'),
										);
									?>
									<?php
										echo $this->Form->postLink(
											'Excluir',
											array('action' => 'delete', $espaco['Espaco']['id']),
											array('class' => 'btn btn-danger m-1', 'confirm' => 'Tem certeza?')
										);
									?>
								</td>
							</tr>
						<?php endforeach; ?>
						<?php unset($espaco); ?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
