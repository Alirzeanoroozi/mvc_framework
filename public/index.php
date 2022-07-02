<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Alireza\Untitled\controllers\AuthController;
use Alireza\Untitled\controllers\SiteController;
use Alireza\Untitled\core\Application;
use Alireza\Untitled\models\User;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'\\..');
$dotenv->safeLoad();


$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
$app = new Application(__DIR__. '\\..', $config);



$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->get('/editProfile', [SiteController::class, 'editProfile']);

$app -> run();
