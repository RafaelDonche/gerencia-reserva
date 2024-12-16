<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $layout = 'login';

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // Redireciona para a página inicial ou a página que tentou acessar
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->error('Nome de usuário ou senha inválidos.');
            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}
