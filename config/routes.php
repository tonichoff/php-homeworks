<?php

return [
    'GET' => [
        'login' => [
            'controller' => 'login',
            'action' => 'show'
        ],

        'register' => [
            'controller' => 'register',
            'action' => 'show'
        ],

        'profile/([0-9])+' => [
            'controller' => 'profile',
            'action' => 'profile'
        ],

        '' =>   [
            'controller' => 'main',
            'action' => 'index'
        ],
    ],

    'POST' => [
        'register' => [
            'controller' => 'register',
            'action' => 'register'
        ],

        'login' => [
            'controller' => 'login',
            'action' => 'login'
        ],

        'api/check_input_register' => [
            'controller' => 'API',
            'action' => 'checkInputRegister'
        ],

        'api/check_input_login' => [
            'controller' => 'API',
            'action' => 'checkInputLogin'
        ],
    ],
];