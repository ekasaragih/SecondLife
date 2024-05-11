<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish
    | to use as your default connection for all hashid work.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashid Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application.
    |
    */
    'connections' => [

        'main' => [
            'salt' => 'Ian',
            'length' => 4,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        ],

        'alternative' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
            // 'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        ],

    ],

];
