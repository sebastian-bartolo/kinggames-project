<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'usuarios',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios', // Cambiado de 'users' a 'usuarios'
        ],
    ],

    'providers' => [
        'usuarios' => [ // Nueva entrada para el provider 'usuarios'
            'driver' => 'eloquent',
            'model' => App\Models\Usuario::class,
        ],

        'usuarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\usuario::class,
        ],

         'users' => [
             'driver' => 'database',
             'table' => 'users',
        ],
    ],

    'passwords' => [
        'usuarios' => [
            'provider' => 'usuario',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
