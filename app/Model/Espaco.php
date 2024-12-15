<?php

class Espaco extends AppModel {
	protected $_schema = array(
		'endereco' => array(
			'type' => 'string',
			'length' => 255
		),
		'telefone' => array(
			'type' => 'string',
			'length' => 15
		),
		'lotacao' => array('type' => 'integer'),
		'hora_inicio' => array('type' => 'time'),
		'hora_fim' => array('type' => 'time')
	);

	public $validate = array(
        'endereco' => array(
            'rule' => 'notBlank',
			'message' => 'Este campo é obrigatório.'
        ),
        'lotacao' => array(
            'rule' => 'naturalNumber',
			'message' => 'Este campo deve ser um número inteiro.'
        )
    );
}
