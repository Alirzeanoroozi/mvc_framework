<?php

namespace Alireza\Untitled\core;

use Alireza\Untitled\core\middlewares\AuthMiddleware;
use Alireza\Untitled\core\middlewares\BaseMiddleware;

class Controller
{
    public array $middlewares = [];
    public string $action = '';

    public string $layout = "main";

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }


    public function registerMiddleware(AuthMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;

    }
}