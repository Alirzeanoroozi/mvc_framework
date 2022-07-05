<?php

namespace Alireza\Untitled\core\middlewares;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\exception\ForbiddenException;

class AuthMiddleware
{
    public array $actions = [];
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()){
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}