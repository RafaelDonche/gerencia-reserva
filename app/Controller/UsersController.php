<?php

class UsersController extends Controller {

	public function index() {
		App::uses('Security', 'Utility');

		// Substitua 'minha_senha' pela senha desejada.
		$senha = '123456';

		// Substitua 'seu_salt_aqui' pelo valor do 'Security.salt' do arquivo Config/core.php.
		$salt = 'DYhG9FOgj1pfIxfs2guhs9LbWwvniR2G0FgaC9mi';

		// Gerar o hash
		$hash = Security::hash($senha, 'sha1', $salt);
		echo $hash;
	}
}

?>
