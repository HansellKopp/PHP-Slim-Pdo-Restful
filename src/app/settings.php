<?php
/**
 *  Definition of application settings
 *
 * @author hansellkopp <hansellkopp@gmail.com>
 */
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Monolog settings
        'logger' => [
            'name' => 'App',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        // Values come from docker environment settings
        'pdo' => [
            'engine' => 'mysql',
            'host' => 'db',
            'database' => getenv('MYSQL_DATABASE'),
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
            'charset' => 'UTF8',
            'collation' => 'utf8_unicode_ci',
            'unix_socket' => '/var/run/mysqld/mysqld.sock',

            'options' => [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => true,
                ],
        ],

    ],
];
