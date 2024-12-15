<?php

class EspacosController extends AppController {
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');

    public function index() {
        $this->set('espacos', $this->Espaco->find('all'));
    }

	public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Item não encontrado.'));
        }

        $espaco = $this->Espaco->findById($id);
        if (!$espaco) {
            throw new NotFoundException(__('Item não encontrado.'));
        }
        $this->set('espaco', $espaco);
    }

	public function add() {
        if ($this->request->is('post')) {
            $this->Espaco->create();
            if ($this->Espaco->save($this->request->data)) {
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

		$espaco = $this->Espaco->findById($id);
		if (!$espaco) {
			throw new NotFoundException(__('Item não encontrado.'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Espaco->id = $id;
			if ($this->Espaco->save($this->request->data)) {
				$this->Flash->success(__('Atualizado com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Não foi possível salvar.'));
		}

		if (!$this->request->data) {
			$this->request->data = $espaco;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Espaco->delete($id)) {
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
