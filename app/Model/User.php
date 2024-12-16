<?php

// app/Model/User.php
App::uses('AppModel', 'Model');

class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'O campo nome é obrigatório.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'O campo senha é obrigatório.'
            )
        )
    );
}
