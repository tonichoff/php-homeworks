<?php

return [
    'GET' => [
        'login' => [
            'controller' => 'login',
            'action' => 'login'
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
        ]
    ],

    'POST' => [
        'register' => [
            'controller' => 'register',
            'action' => 'register'
        ]
    ]
];