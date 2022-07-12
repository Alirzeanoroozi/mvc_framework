<?php

namespace Alireza\Untitled\service;

use Alireza\Untitled\core\Request;
use Alireza\Untitled\models\LoginModel;
use Alireza\Untitled\models\User;

class AuthService
{
    /**
     * @param Request $request
     * @return array
     */
    public static function loginService(Request $request)
    {
        $loginModel = new LoginModel();
        if($request->isPost()){
            $loginModel->loadData($request->getBody());
            if($loginModel->validate() && $loginModel->login()){
                return ["post" => true, "model" => $loginModel];
            }
        }
        return ["post" => false, "model" => $loginModel];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function registerService(Request $request)
    {
        $user = new User();
        if($request->isPost()){
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()){
                return ["post" => true, "model" => $user];
            }
        }
        return ["post" => false, "model" => $user];
    }

}