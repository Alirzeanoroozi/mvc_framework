<?php

namespace Alireza\Untitled\core\form;

use Alireza\Untitled\core\Model;

class Form
{

    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        return '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }

    public function __toString()
    {
        return "";
    }
}