<?php
require_once __DIR__ . '/vendor/autoload.php';

use Alireza\Untitled\controllers\AuthController;
use Alireza\Untitled\controllers\SiteController;
use Alireza\Untitled\core\Application;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();


$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
$app = new Application(__DIR__ . '\\..', $config);
$app->db->applyMigrations();


