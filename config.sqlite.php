<?php

return [
    'database' => [
        'name' => '', // ;dbname=
        'username' => '',
        'password' => '',
        'connection' => 'sqlite:local-db.sqlite3',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
