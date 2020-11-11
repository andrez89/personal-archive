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
        'url' => 'http://51.75.254.233:8014',
        "dir" => "",
        "SSL" => false,
        "error_reporting" => E_ALL,
        "display_errors" => 1,
        "server" => "server"
    ]
];
