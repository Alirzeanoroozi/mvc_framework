<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Alireza\Untitled\controllers\AuthController;
use Alireza\Untitled\controllers\BlogController;
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

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/post_page', [BlogController::class, 'post']);
$app->router->post('/post_page', [BlogController::class, 'post']);

$app->router->get('/list', [BlogController::class, 'list']);
$app->router->get('/delete', [BlogController::class, 'delete']);
$app->router->get('/view', [BlogController::class, 'view']);
$app->router->get('/edit', [BlogController::class, 'edit']);
$app->router->post('/edit', [BlogController::class, 'edit']);


$app->router->get('/profile', [BlogController::class, 'profile']);

$app -> run();
