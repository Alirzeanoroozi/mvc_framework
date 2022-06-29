<?php

namespace Alireza\Untitled\core;

use Alireza\Untitled\models\User;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public session $session;
    public Database $db;
    public static string $Root_DIR;
    public static Application $app;
    public Controller $controller;
    public ?DBModel $user;

    public function __construct($rootPath, $config){
        $this->userClass = $config['userClass'];
        self::$Root_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->controller = new Controller();
        $this->session = new session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if($primaryValue){
            $primaryKey = ($this->userClass)::primaryKey();
            $this->user = ($this->userClass)::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }

    }

    public function run(){
        echo $this -> router -> resolve();
    }

    public function login(DBModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}