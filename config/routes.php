<?php

return [
    'login' => [
        'controller' => 'login',
        'action' => 'login'
    ],

    'register' => [
        'controller' => 'register',
        'action' => 'register'
    ],

    'profile/([0-9])+' => [
        'controller' => 'profile',
        'action' => 'profile'
    ],

    '' => [
        'controller' => 'main',
        'action' => 'index'
    ]
];