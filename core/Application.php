<?php

namespace Alireza\Untitled\core;

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

    public function __construct($rootPath, $config){
        self::$Root_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->controller = new Controller();
        $this->session = new session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
    }

    public function run(){
        echo $this -> router -> resolve();
    }
}