<?php
namespace Alireza\Untitled\controllers;
use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\middlewares\AuthMiddleware;

class Controller
{
    public array $middlewares = [];
    public string $action = '';
    public string $layout = "main";

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }
    public function registerMiddleware(AuthMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}