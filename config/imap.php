<?php

return [
    /*
    |--------------------------------------------------------------------------
    | IMAP Host Address
    |--------------------------------------------------------------------------
    */
    'default' => 'default',

    'accounts' => [
        'default' => [
            'host' => 'imap.gmail.com',
            'port' => 993,
            'encryption' => 'ssl', // Supported: false, 'ssl', 'tls'
            'validate_cert' => true,
            'username' => '',
            'password' => '',
        ],

        'gmail' => [
            'host' => 'imap.gmail.com',
            'port' => 993,
            'encryption' => 'ssl', // Supported: false, 'ssl', 'tls'
            'validate_cert' => true,
            'username' => '',
            'password' => '',
        ],

        'another' => [
            'host' => '',
            'port' => 993,
            'encryption' => false, // Supported: false, 'ssl', 'tls'
            'validate_cert' => true,
            'username' => '',
            'password' => '',
        ]
    ],
];
