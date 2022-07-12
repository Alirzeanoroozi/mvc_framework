<?php
namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\middlewares\AuthMiddleware;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\service\AuthService;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile', 'editProfile', 'post_page']));
    }

    public function home()
    {
        return $this->render('home', ["name" => (Application::$app->user) ? Application::$app->user->firstname : "guest"]);
    }

    public function register(Request $request)
    {
        $return_array = AuthService::registerService($request);
        if($return_array["post"]) {
            Application::$app->session->setFlash('success', 'Thanks for registering');
            Application::$app->response->redirect('/');
        }
        return $this->render('register', $return_array);
    }

    public function login(Request $request)
    {
        $return_array = AuthService::loginService($request);
        if($return_array["post"]) {
            Application::$app->session->setFlash('success', "welcome!");
            Application::$app->response->redirect('/');
        }
        return $this->render('login', $return_array);
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect("/");
    }
}