<?php

namespace Alireza\Untitled\service;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\Request;
use Alireza\Untitled\models\EditModel;
use Alireza\Untitled\models\ListModel;
use Alireza\Untitled\models\LoginModel;
use Alireza\Untitled\models\User;
use Alireza\Untitled\models\PostModel;

class BlogService
{

    /**
     * @param Request $request
     * @return array
     */
    public static function viewService(Request $request): array
    {
        $inscription = Queries::search("inscriptions", $request->getBody()["id"]);
        return
            [
                "id" => $inscription["id"],
                "subject" => $inscription["subject"],
                "authorFirstName" => (new User)->findOne(["id" => $inscription["author_id"]])->firstname,
                "authorLastName" => (new User)->findOne(["id" => $inscription["author_id"]])->lastname,
                "content" => $inscription["content"],
                "date" => $inscription["created_at"]
            ];
    }

    /**
     * @param Request $request
     * @return void
     */
    public static function deleteService(Request $request): void
    {
        Queries::delete("inscriptions", $request->getBody()["id"]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function editService(Request $request): array
    {
        $editModel = new EditModel();
        $editModel->loadData($request->getBody());

        $editModel->fillData(Queries::search("inscriptions", $editModel->id));

        if($request->isPost()){
            $editModel->loadData($request->getBody());
            $editModel->update();
            return ["post" => true, "model" => $editModel];
        }
        return ["post" => false, "model" => $editModel];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function searchService(Request $request): array
    {
        $page = key_exists("page", $request->getBody()) ? $request->getBody()["page"] : 0;
        $searchInput = key_exists("searchInput", $request->getBody()) ? $request->getBody()["searchInput"] : '';
        $listModel = new ListModel();
        $listModel->loadData($request->getBody());
        return ['model' => $listModel, 'inscriptions' => Queries::searchLike($searchInput), "page" => $page, 'searchInput' => $searchInput];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function profileService(Request $request): array
    {
        $profileId = array_key_exists("id", $request->getBody()) ? $request->getBody()["id"] : Application::$app->user->id;
        $author = Queries::search("users", $profileId);

        $inscriptions = Queries::searchAllAuthors("inscriptions",$profileId);

        return [
            "id" => $author["id"],
            "firstname" => $author["firstname"],
            "lastname" => $author["lastname"],
            "inscriptionNumbers" => count($inscriptions),
            "inscriptions" => $inscriptions
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function registerService(Request $request)
    {
        $user = new User();
        if($request->isPost()){
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()){
                return [
                  "post" => true,
                  "model" => $user
                ];
            }
        }
        return [
            "post" => false,
            "model" => $user
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function postService(Request $request)
    {
        $postModel = new PostModel();
        if($request->isPost()){
            $postModel->loadData($request->getBody());
            if($postModel->store()){
                return [
                    "post" => true,
                    "model" => $postModel
                ];
            }
        }
        return [
            "post" => false,
            "model" => $postModel
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function loginService(Request $request)
    {
        $loginModel = new LoginModel();
        if($request->isPost()){
            $loginModel->loadData($request->getBody());
            if($loginModel->validate() && $loginModel->login()){
                return [
                    "post" => true,
                    "model" => $loginModel
                ];
            }
        }
        return [
            "post" => false,
            "model" => $loginModel
        ];
    }
}