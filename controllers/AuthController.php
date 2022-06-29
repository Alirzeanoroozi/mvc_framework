<?php

namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\Controller;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\core\Response;
use Alireza\Untitled\models\LoginForm;
use Alireza\Untitled\models\User;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $this->setLayout("auth");
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }
        return $this->render('login', ['model' => $loginForm]);
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