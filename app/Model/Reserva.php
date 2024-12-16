<?php

class Reserva extends AppModel {
	public $belongsTo = ['Espaco'];

	public $hasAndBelongsToMany = [
        'Adicional' => [
            'className' => 'Adicional',
            'joinTable' => 'reservas_adicionals',
            'foreignKey' => 'reserva_id',
            'associationForeignKey' => 'adicional_id',
            'unique' => true,
        ]
    ];

	public $validate = array(
		'espaco_id' => array(
            'rule' => 'notBlank',
			'message' => 'O campo espaço é obrigatório.'
		),
        'cliente_nome' => array(
            'rule' => 'notBlank',
			'message' => 'O campo nome do cliente é obrigatório.'
        ),
        'cliente_cpf' => array(
            'rule' => 'notBlank',
			'message' => 'O campo CPF do cliente é obrigatório.'
        ),
        'inicio' => array(
            'rule' => 'validateHorario',
			'message' => 'O horário selecionado está indisponível ou fora do horário de funcionamento do espaço.'
        ),
        'fim' => array(
            'rule' => 'notBlank',
			'message' => 'O campo fim da reserva é obrigatório.'
		)
    );

	public function validateHorario($check) {
		$reserva = $this->data[$this->alias];
        $inicio = $reserva['inicio'];
        $fim = $reserva['fim'];
        $espacoId = $reserva['espaco_id'];
		$reservaId = isset($reserva['id']) ? $reserva['id'] : null;

        // Busca o horário de funcionamento do espaço
        $espaco = $this->Espaco->find('first', [
            'conditions' => ['Espaco.id' => $espacoId],
            'fields' => ['Espaco.hora_inicio', 'Espaco.hora_fim'],
            'recursive' => -1
        ]);

        if (!$espaco) {
            return false; // Espaço inválido
        }

        $horaInicioEspaco = $espaco['Espaco']['hora_inicio'];
        $horaFimEspaco = $espaco['Espaco']['hora_fim'];

        // Verifica se a reserva está dentro do horário de funcionamento
        if (!$this->isWithinOperatingHours($inicio, $fim, $horaInicioEspaco, $horaFimEspaco)) {
            return false;
        }

        // Adiciona 1 hora de preparação antes e depois da reserva
        $inicioComPreparacao = date('Y-m-d H:i:s', strtotime($inicio . ' -1 hour'));
        $fimComPreparacao = date('Y-m-d H:i:s', strtotime($fim . ' +1 hour'));

		// Consulta para verificar se há conflitos de horários para o mesmo espaço
		$conditions = [
			'Reserva.espaco_id' => $reserva['espaco_id'], // Espaço associado
			'OR' => [
				['Reserva.inicio <=' => $inicioComPreparacao, 'Reserva.fim >=' => $inicioComPreparacao], // Conflito de início
				['Reserva.inicio <=' => $fimComPreparacao, 'Reserva.fim >=' => $fimComPreparacao], // Conflito de fim
				['Reserva.inicio >=' => $inicioComPreparacao, 'Reserva.fim <=' => $fimComPreparacao] // Dentro do intervalo
			]
		];

		// Exclui a reserva atual da verificação (em caso de edição)
		if ($reservaId) {
			$conditions['Reserva.id !='] = $reservaId;
		}

		$conflito = $this->find('count', [
			'conditions' => $conditions
		]);

        return $conflito == 0;
    }

    // Método para verificar se a reserva está dentro do horário de funcionamento
    private function isWithinOperatingHours($inicio, $fim, $horaInicioEspaco, $horaFimEspaco) {
        // Extrai apenas a hora do horário de início e término da reserva
        $horaInicioReserva = date('H:i:s', strtotime($inicio));
        $horaFimReserva = date('H:i:s', strtotime($fim));

        // Verifica se o horário está dentro do horário de funcionamento
        return (
            $horaInicioReserva >= $horaInicioEspaco &&
            $horaFimReserva <= $horaFimEspaco
        );
    }
}
