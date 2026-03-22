<?php
return [
    'database' => [
        'host' => 'localhost',
        'name' => 'online_diary',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    ],
    'app' => [
        'name' => 'Онлайн-щоденник',
        'url' => 'http://back-end.local',
        'timezone' => 'Europe/Kiev',
        'debug' => true,
        'version' => '1.0.0',
    ],
    'session' => [
        'name' => 'diary_session',
        'lifetime' => 86400,
        'path' => '/',
        'domain' => 'back-end.local',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ],
    'paths' => [
        'views' => ROOT_DIR . '/app/Views/',
        'uploads' => ROOT_DIR . '/uploads/',
        'logs' => ROOT_DIR . '/logs/',
        'public' => ROOT_DIR . '/public/',
    ],
    'environment' => 'development',
];
