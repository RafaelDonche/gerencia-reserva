<?php

class ReservasController extends AppController {
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
	public $uses = ['Reserva', 'Adicional'];

    public function index() {
		// Busca todas as estruturas para o select
		$estruturas = $this->Reserva->Adicional->find('list', [
			'fields' => ['Adicional.id', 'Adicional.nome'] // Assume que a tabela `estruturas` tem um campo `nome`
		]);

		// Envia para a View
		// $this->set(compact('estruturas'));

        $this->set(array('reservas' => $this->Reserva->find('all'), 'estruturas' => $estruturas));
    }

	public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Item não encontrado.'));
        }

        $reserva = $this->Reserva->findById($id);
        if (!$reserva) {
            throw new NotFoundException(__('Item não encontrado.'));
        }
        $this->set('reserva', $reserva);
    }

	public function add() {
        if ($this->request->is('post')) {
            $this->Reserva->create();
			$data = $this->request->data;
			$data['Reserva']['cliente_cpf'] = preg_replace('/[^0-9]/', '', $data['Reserva']['cliente_cpf']);
            if ($this->Reserva->save($data)) {
                $this->Flash->success(__('Cadastrado com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Não foi possível salvar.'));
			$this->redirect($this->referer());
        }
    }

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Item não encontrado.'));
		}

		$reserva = $this->Reserva->findById($id);
		if (!$reserva) {
			throw new NotFoundException(__('Item não encontrado.'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Reserva->id = $id;
			if ($this->Reserva->save($this->request->data)) {
				$this->Flash->success(__('Atualizado com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Não foi possível salvar.'));
		}

		if (!$this->request->data) {
			$this->request->data = $reserva;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Reserva->delete($id)) {
			$this->Flash->success(
				__('Excluído com sucesso.')
			);
		} else {
			// $this->Flash->error(
			// 	__('The post with id: %s could not be deleted.', h($id))
			// );
			$this->Flash->error(
				__('Não foi possível excluir.')
			);
		}

		return $this->redirect(array('action' => 'index'));
	}
}
