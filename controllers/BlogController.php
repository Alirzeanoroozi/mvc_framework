<?php

namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\service\BlogService;

class BlogController extends Controller
{
    public function profile(Request $request)
    {
        $profileId = array_key_exists("id", $request->getBody()) ? $request->getBody()["id"] : Application::$app->user->id;
        $params = BlogService::profileService($profileId);
        return $this->render('profile', $params);
    }

    public function post(Request $request)
    {
        $return_array = BlogService::postService($request);
        if($return_array["post"]) {
            Application::$app->session->setFlash('success', "your text successfully stored!");
            Application::$app->response->redirect('/');
        }
        return $this->render('post_page', $return_array);
    }

    public function list(Request $request)
    {
        return $this->render('list', BlogService::listService($request->getBody()));
    }

    public function delete(Request $request)
    {
        BlogService::deleteService($request->getBody()["id"]);
        Application::$app->session->setFlash('success', 'Inscription Deleted');
        Application::$app->response->redirect('/list');
        return true;
    }

    public function view(Request $request)
    {
        return $this->render('viewPage', BlogService::viewService($request->getBody()["id"]));
    }

    public function edit(Request $request)
    {
        $return_array = BlogService::editService($request->getBody(), $request->isPost());
        if($return_array["post"]) {
            Application::$app->session->setFlash('success', "your text successfully updated!");
            Application::$app->response->redirect('/list');
        }
        return $this->render('editPage', $return_array);
    }
}