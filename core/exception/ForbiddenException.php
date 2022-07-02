<?php

namespace Alireza\Untitled\core\exception;

class ForbiddenException extends \Exception
{
    protected $message = "You don't have access";
    protected $code = 403;
}