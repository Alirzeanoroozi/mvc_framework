<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Alireza\Untitled\controllers\AuthController;
use Alireza\Untitled\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'\\..');
$dotenv->safeLoad();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(__DIR__. '\\..', $config);

$app->router->get('/', [AuthController::class, 'home']);

$app->router->get('/contact', [AuthController::class, 'contact']);
$app->router->post('/contact', [AuthController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/post_page', [AuthController::class, 'postPage']);
$app->router->post('/post_page', [AuthController::class, 'postPage']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/list', [AuthController::class, 'list']);
$app->router->get('/delete', [AuthController::class, 'delete']);
$app->router->get('/view', [AuthController::class, 'view']);
$app->router->get('/edit', [AuthController::class, 'edit']);
$app->router->post('/edit', [AuthController::class, 'edit']);

$app->router->get('/search', [AuthController::class, 'search']);
$app->router->post('/search', [AuthController::class, 'search']);

$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->get('/editProfile', [AuthController::class, 'editProfile']);


$app -> run();
