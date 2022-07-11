<?php

namespace Alireza\Untitled\controllers;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\service\BlogService;

class BlogController extends Controller
{
    public function profile(Request $request): array|bool|string
    {
        $params = BlogService::profileService($request);
        return $this->render('profile', $params);
    }

    public function post(Request $request): array|bool|string
    {
        $return_array = BlogService::postService($request);
        if($return_array["post"]) {
            Application::$app->session->setFlash('success', "your text successfully stored!");
            Application::$app->response->redirect('/');
        }
        return $this->render('post_page', ['model' => $return_array["model"]]);
    }

    public function list(Request $request): array|bool|string
    {
        return $this->render('list', BlogService::searchService($request));
    }

    public function delete(Request $request): bool
    {
        BlogService::deleteService($request);
        Application::$app->session->setFlash('success', 'Inscription Deleted');
        Application::$app->response->redirect('/list');
        return true;
    }

    public function view(Request $request): array|bool|string
    {
        $params = BlogService::viewService($request);
        return $this->render('viewPage', $params);
    }

    public function edit(Request $request): array|bool|string
    {
        $return_array = BlogService::editService($request);
        if($return_array["post"]) {
            Application::$app->session->setFlash('success', "your text successfully updated!");
            Application::$app->response->redirect('/list');
        }
        return $this->render('editPage', ['model' => $return_array["model"]]);
    }

}