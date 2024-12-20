<div class="card">

    <div class="card-hearder">
        <h2 class="text-title">Gerencie as reservas</h2>
    </div>

    <div class="card-body mb-3">

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->Form->create('Reserva',  array('url' => array('controller' => 'reservas', 'action' => 'add'))); ?>
		<div class="row">
			<div class="col-md-12">
				<h4>Adicionar uma nova reserva</h4>
				<hr class="mt-0">
			</div>
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
							echo '<option value="'.$id.'">'.$endereco.'</option>';
						}
					?>
				</select>
			</div>
			<div class="col-md-4 mb-3">
				<label class="form-label" for="ReservaInicio">Início da reserva</label>
				<input class="form-control" type="datetime-local" name="data[Reserva][inicio]">
			</div>
			<div class="col-md-4 mb-3">
				<label class="form-label" for="ReservaFim">Fim da reserva</label>
				<input class="form-control" type="datetime-local" name="data[Reserva][fim]">
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
								<th>Espaço</th>
								<th>Cliente</th>
								<th>Data e horário <br> reservado</th>
								<th>Serviços</th>
								<th>Estruturas adicionais</th>
								<th>Ações</th>
							</tr>
						</thead>

						<tbody>
						<?php foreach ($reservas as $reserva): ?>
							<tr>
								<td>
									<?php echo $reserva['Espaco']['endereco']; ?>
								</td>
								<td>
									Nome: <?php echo $reserva['Reserva']['cliente_nome']; ?> <br>
									CPF: <span class="cpf"><?php echo $reserva['Reserva']['cliente_cpf']; ?></span>
								</td>
								<td>
									Início: <?php echo date('d/m/Y H:i', strtotime($reserva['Reserva']['inicio'])); ?> <br>
									Fim: <?php echo date('d/m/Y H:i', strtotime($reserva['Reserva']['fim'])); ?>
								</td>
								<td>
									Quantidade de recepcionistas: <?php echo $reserva['Reserva']['recepcao']; ?> <br>
									Coffe-break: <?php $reserva['Reserva']['coffe_break']; ?>
								</td>
								<td>
									<?php if (!empty($reserva['Adicional'])): ?>
										<ul>
											<?php foreach ($reserva['Adicional'] as $adicional): ?>
												<li><?= h($adicional['nome']); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php else: ?>
										Nenhuma
									<?php endif; ?>
								</td>
								<td>
									<?php
										echo $this->Html->link(
											'Editar',
											array('action' => 'edit', $reserva['Reserva']['id']),
											array('class' => 'btn btn-secondary m-1'),
										);
									?>
									<?php
										echo $this->Form->postLink(
											'Excluir',
											array('action' => 'delete', $reserva['Reserva']['id']),
											array('class' => 'btn btn-danger m-1', 'confirm' => 'Tem certeza?')
										);
									?>
								</td>
							</tr>
						<?php endforeach; ?>
						<?php unset($reserva); ?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
