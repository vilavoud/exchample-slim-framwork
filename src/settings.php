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

        // Config connect database
        'db' => [
            'host' => 'localhost',
            'dbname' => 'stockrestdb',
            'user' => 'root',
            'pass' => '1234',
        ],

        // jwt settings
        "jwt" => [
            'secret' => 'itgeniussupersecretepassword2020'
        ]
    ],
];
