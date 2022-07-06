<?php

namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\Controller;
use Alireza\Untitled\core\middlewares\AuthMiddleware;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\core\Response;
use Alireza\Untitled\models\EditModel;
use Alireza\Untitled\models\ListModel;
use Alireza\Untitled\models\LoginForm;
use Alireza\Untitled\models\User;
use Alireza\Untitled\models\WriteForm;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile', 'editProfile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $name = Application::$app->user->firstname. " ".Application::$app->user->lastname;
                Application::$app->session->setFlash('welcome', "welcome $name");
                $response->redirect('/');
            }
        }
        return $this->render('login', ['model' => $loginForm]);
    }

    public function postPage(Request $request, Response $response)
    {
        $writeForm = new writeForm();
        if($request->isPost()){
            $writeForm->loadData($request->getBody());
            if($writeForm->store()){
                Application::$app->session->setFlash('success', "your text successfully stored!");
                $response->redirect('/');
            }
        }
        return $this->render('post_page', ['model' => $writeForm]);
    }

    public function register(Request $request)
    {
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

    public function profile(Request $request)
    {
        $profileId = array_key_exists("id", $request->getBody()) ? $request->getBody()["id"] : Application::$app->user->id;
        $statement  = Application::$app->db->pdo->prepare("Select * from users where id='$profileId'");
        $statement->execute();
        $author = $statement->fetch();

        $statement_ins  = Application::$app->db->pdo->prepare("Select * from inscriptions where author_id='$profileId'");
        $statement_ins->execute();
        $inscriptions = $statement_ins->fetchALL();
        $params= [
            "id" => $author["id"],
            "firstname" => $author["firstname"],
            "lastname" => $author["lastname"],
            "inscriptionNumbers" => count($inscriptions),
            "inscriptions" => $inscriptions
        ];
        return $this->render('profile', $params);
    }

    public function editProfile()
    {
        return $this->render('editProfile');
    }

    public function list(Request $request)
    {
        $page = key_exists("page", $request->getBody()) ? $request->getBody()["page"] : 0;
        $params = [
            "page" => $page
        ];
        return $this->render('list', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function home()
    {
        $name = (Application::$app->user) ? Application::$app->user->firstname : "guest";
        $params= [
            "name" => $name
        ];
        return $this->render('home', $params);
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();

        return 'Handling submitted data';
    }

    public function delete(Request $request)
    {
        $deleteId = $request->getBody()["id"];
        $statement  = Application::$app->db->pdo->prepare("DELETE from inscriptions where id='$deleteId'");
        $statement->execute();
        Application::$app->session->setFlash('success', 'Inscription Deleted');
        Application::$app->response->redirect('/list');
        return true;
    }

    public function view(Request $request)
    {
        $viewId = $request->getBody()["id"];
        $statement  = Application::$app->db->pdo->prepare("Select * from inscriptions where id='$viewId'");
        $statement->execute();
        $inscription = $statement->fetch();
        $params= [
            "id" => $inscription["id"],
            "subject" => $inscription["subject"],
            "authorFirstName" => (new User)->findOne(["id" => $inscription["author_id"]])->firstname,
            "authorLastName" => (new User)->findOne(["id" => $inscription["author_id"]])->lastname,
            "content" => $inscription["content"],
            "date" => $inscription["created_at"]
        ];
        return $this->render('view', $params);
    }

    public function edit(Request $request, Response $response)
    {
        $editModel = new EditModel();
        $editModel->loadData($request->getBody());
        $editModel->fillData();
        if($request->isPost()){
            $editModel->loadData($request->getBody());
            if($editModel->update()){
                Application::$app->session->setFlash('success', "your text successfully updated!");
                $response->redirect('/list');
            }
        }
        return $this->render('editPage', ['model' => $editModel]);
    }

    public function search(Request $request)
    {
        $listModel = new ListModel();
        if($request->isPost()){
            $listModel->loadData($request->getBody());
            $listModel->search();
        }
        return $this->render('search', ['model' => $listModel]);
    }
}