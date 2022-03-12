<?php

return [
    'database' => [
        'name' => 'resources',
        'username' => 'resources',
        'password' => 'reS298re',
        'connection' => 'mysql:host=za48251-001.dbaas.ovh.net:35947',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'server' => [
        'url' => 'https://amovez.it/resources',
        "dir" => "",
        "SSL" => true,
        "error_reporting" => E_ALL,
        "display_errors" => 1,
        "server" => "server"
    ]
];
