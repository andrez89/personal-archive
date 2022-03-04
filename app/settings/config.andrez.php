<?php

return [
    'database' => [
        'name' => 'resources',
        'username' => 'root',
        'password' => 'password',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'server' => [
        'url' => 'http://localhost/resources',
        "dir" => "resources/",
        "SSL" => false,
        "error_reporting" => E_ALL,
        "display_errors" => 1,
        "server" => "andrez"
    ]
];
