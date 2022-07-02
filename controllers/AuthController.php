<?php

namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\Controller;
use Alireza\Untitled\core\middlewares\AuthMiddleware;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\core\Response;
use Alireza\Untitled\models\LoginForm;
use Alireza\Untitled\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $this->setLayout("auth");
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $name = Application::$app->user->firstname. " ".Application::$app->user->lastname;
                Application::$app->session->setFlash('success', "welcome $name");
                $response->redirect('/');
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

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect("/");
    }

    public function profile()
    {
        return $this->render('profile');
    }

}