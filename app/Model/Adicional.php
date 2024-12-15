<?php

class Adicional extends AppModel {
    public $hasAndBelongsToMany = [
        'Reserva' => [
            'className' => 'Reserva',
            'joinTable' => 'reservas_adicionals',
            'foreignKey' => 'adicional_id',
            'associationForeignKey' => 'reserva_id',
            'unique' => false,
        ]
    ];
}
