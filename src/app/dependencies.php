<?php
/**
 * Initialize base funcionality for services:
 *  - Dependency Container
 *  - Application Logger
 * @author hansellkopp <hansellkopp@gmail.com>
 */
use Slim\PDO\Database;

 // Dependency container
$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Inject a new instance of Slim PDO in the container
$container['pdo'] = function ($c) {
    $pdo = $c->get('settings')['pdo'];
    $dsn = "{$pdo['engine']}:host={$pdo['host']};dbname={$pdo['database']}";
    $slimPdo = new \Slim\PDO\Database($dsn, $pdo['username'], $pdo['password'], $pdo['options']);
    return $slimPdo;
};

// Register view engine on container
$container['view'] = function ($c) {
    return new \Slim\Views\PhpRenderer('../public/');
};
