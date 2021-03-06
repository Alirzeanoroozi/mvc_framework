<?php
namespace Alireza\Untitled\core;
use Alireza\Untitled\controllers\Controller;
use Alireza\Untitled\models\DBModel;
use Alireza\Untitled\models\User;
use Alireza\Untitled\views\View;

class Application
{
    public static string $Root_DIR;
    public static Application $app;

    public View $view;
    public Router $router;
    public Request $request;
    public Response $response;
    public session $session;
    public Database $db;


    public Controller $controller;
    public ?DBModel $user;

    public function __construct($rootPath, $config){
        self::$Root_DIR = $rootPath;
        self::$app = $this;

        $this->response = new Response();
        $this->request = new Request();
        $this->controller = new Controller();
        $this->session = new session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        $primaryKey = User::primaryKey();
        $this->user = (new User())->findOne([$primaryKey => $primaryValue]) ? (new User())->findOne([$primaryKey => $primaryValue]) : null;
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run(){
        try{
            echo $this -> router -> resolve();
        }catch (\Exception $e){
            echo $this->view->renderView('_404');
        }
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