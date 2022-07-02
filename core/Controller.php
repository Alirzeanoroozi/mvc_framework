<?php

namespace Alireza\Untitled\core;

use Alireza\Untitled\core\middlewares\BaseMiddleware;

class Controller
{
    public array $middlewares = [];
    public string $action = '';

    public string $layout = "main";

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }


    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;

    }
}