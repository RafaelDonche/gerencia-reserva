<?php

class Reserva extends AppModel {
	public $belongsTo = ['Espaco'];

	public $hasAndBelongsToMany = [
        'Adicional' => [
            'className' => 'Adicional',
            'joinTable' => 'reservas_adicionals',
            'foreignKey' => 'reserva_id',
            'associationForeignKey' => 'adicional_id',
            'unique' => false,
        ]
    ];

	public $validate = array(
		'espaco_id' => array(
            'rule' => 'notBlank',
			'message' => 'Este campo é obrigatório.'
		),
        'cliente_nome' => array(
            'rule' => 'notBlank',
			'message' => 'Este campo é obrigatório.'
        ),
        'cliente_cpf' => array(
            'rule' => 'notBlank',
			'message' => 'Este campo é obrigatório.'
        ),
        'inicio' => array(
            'rule' => 'validateHorario',
			'message' => 'O horário selecionado está indisponível ou fora do horário de funcionamento do espaço.'
        ),
        'fim' => array(
            'rule' => 'notBlank',
			'message' => 'Este campo é obrigatório.'
		)
    );

	public function validateHorario($check) {
        $inicio = $this->data[$this->alias]['inicio']; // Horário de início da reserva
        $fim = $this->data[$this->alias]['fim'];       // Horário de término da reserva
        $espacoId = $this->data[$this->alias]['espaco_id']; // ID do espaço associado

        // Busca o horário de funcionamento do espaço
        $espaco = $this->Espaco->find('first', [
            'conditions' => ['Espaco.id' => $espacoId],
            'fields' => ['Espaco.hora_inicio', 'Espaco.hora_fim'],
            'recursive' => -1
        ]);

        if (!$espaco) {
            return false; // Espaço inválido
        }

        $horaInicioEspaco = $espaco['Espaco']['hora_inicio']; // Ex.: '08:00:00'
        $horaFimEspaco = $espaco['Espaco']['hora_fim'];       // Ex.: '22:00:00'

        // Verifica se a reserva está dentro do horário de funcionamento
        if (!$this->isWithinOperatingHours($inicio, $fim, $horaInicioEspaco, $horaFimEspaco)) {
            return false;
        }

        // Adiciona 1 hora de preparação antes e depois da reserva
        $inicioComPreparacao = date('Y-m-d H:i:s', strtotime($inicio . ' -1 hour'));
        $fimComPreparacao = date('Y-m-d H:i:s', strtotime($fim . ' +1 hour'));

        // Verifica se há conflito com outras reservas no mesmo espaço
        $conflito = $this->find('count', [
            'conditions' => [
                'Reserva.espaco_id' => $espacoId,
                'OR' => [
                    // A nova reserva começa ou termina dentro de uma reserva existente
                    [
                        'Reserva.inicio <=' => $fimComPreparacao,
                        'Reserva.fim >=' => $inicioComPreparacao
                    ]
                ]
            ]
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
