<?php
namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\middlewares\AuthMiddleware;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\service\BlogService;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile', 'editProfile', 'post_page']));
    }

    public function home(): array|bool|string
    {
        $name = (Application::$app->user) ? Application::$app->user->firstname : "guest";
        $params= [
            "name" => $name
        ];
        return $this->render('home', $params);
    }

    public function register(Request $request): array|bool|string
    {
        $return_array = BlogService::registerService($request);
        if($return_array["post"]) {
            Application::$app->session->setFlash('success', 'Thanks for registering');
            Application::$app->response->redirect('/');
        }
        return $this->render('register', ['model' => $return_array["model"]]);
    }

    public function login(Request $request): array|bool|string
    {
        $return_array = BlogService::loginService($request);
        if($return_array["post"]) {
            Application::$app->session->setFlash('welcome', "welcome!");
            Application::$app->response->redirect('/');
        }
        return $this->render('login', ['model' => $return_array["model"]]);
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect("/");
    }


}