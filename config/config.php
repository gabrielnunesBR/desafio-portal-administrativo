<?php

require_once dirname(__DIR__) . '/app/Utils/helpers.php';
loadEnv(dirname(__DIR__) . '/.env');

return [
    'db' => [
        'driver'   => getenv('DB_DRIVER'),
        'host'     => getenv('DB_HOST'),
        'port'     => getenv('DB_PORT'),
        'dbname'   => getenv('DB_NAME'),
        'user'     => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
    ]
];
