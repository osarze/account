<?php

return [
    'users' => [
        'table' => 'users',
        'primary_id_column' => 'id',
        'class' => 'dede',
    ],
    'table_name' => 'accounts',
    'account_history_table' => 'account_histories',
    'route' => [
        'prefix' => 'api/account',
        'middleware' => [
            'api',
        ],
        'namespace' => 'Osarze\Account\Http\Controllers',
    ],
];
