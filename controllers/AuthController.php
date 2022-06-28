<?php

namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\Controller;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout("auth");
        if($request->isPost()){
            return 'Handle submitted data';
        }
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $this->setLayout("auth");
        $user = new User();
        if($request->isPost()){
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()){
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
            }
            return $this->render('register', ['model' => $user]);
        }
        return $this->render('register', ['model' => $user]);
    }
}