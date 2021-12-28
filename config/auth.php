<?php
return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
'guards' => [
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],
'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \LawAdvisor\Models\User::class
        ]
    ]
];
