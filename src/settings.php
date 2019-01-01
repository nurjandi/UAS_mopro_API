<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        //database setting
        'db' => [
            'host' => 'ec2-107-20-249-68.compute-1.amazonaws.com',
            'user' => 'louglwadsvfsnu',
            'pass' => '484699fa73c68b471dfabe7dca35618f3407948c011a4780b32f1a6f4c22496e',
            'dbname' => 'deaqtl3k55oibv',
            'driver' => 'pgsql'
        ]
    ],
];
