<?php

return [
    'log_table_name' => 'migrations_log',
    'migration_dirs' => [
        'migrations' => __DIR__ . '/migrations',
        //'second' => __DIR__ . '/second_dir',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'mysql',
            //'version' => '5.7.0', // optional - if not set it is requested from server
            'host' => getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost',
            'port' => getenv('DB_PORT') ? getenv('DB_PORT') : 3306, // optional
            'username' => getenv('DB_USER') ? getenv('DB_USER') : 'admin',
            'password' => getenv('DB_PASS') ? getenv('DB_PASS') : 'yourpass',
            'db_name' => getenv('DB_NAME') ? getenv('DB_NAME') : 'churchappapi',
            'charset' => 'utf8mb4', // optional
            'collation' => 'utf8mb4_unicode_ci', // optional
        ],
        'production' => [
            'adapter' => 'mysql',
            'host' => getenv('PRODUCTION_HOST'),
            'username' => getenv('PRODUCTION_USER'),
            'password' => getenv('PRODUCTION_PASS'),
            'db_name' => getenv('PRODUCTION_DB'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci', // optional
        ],
    ],
    'default_environment ' => 'local',
];
