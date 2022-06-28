<?php

namespace Alireza\Untitled\core;

class session
{

    protected const FLASH_KEY = "flash_messages";

    public function __construct()
    {
        session_start();

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage){
            $flashMessage['remove'] = true;
        }

    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}