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
     * @param $id
     * @return array
     */
    public static function viewService($id): array
    {
        $inscription = Queries::search("inscriptions", $id);
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
     * @param $id
     * @return void
     */
    public static function deleteService($id): void
    {
        Queries::delete("inscriptions", $id);
    }

    /**
     * @param $data
     * @param $isPost
     * @return array
     */
    public static function editService($data, $isPost): array
    {
        $editModel = new EditModel();
        $editModel->loadData($data);
        $editModel->fillData(Queries::search("inscriptions", $editModel->id));

        if($isPost){
            $editModel->loadData($data);
            Queries::update($editModel);
            return ["post" => true, "model" => $editModel];
        }
        return ["post" => false, "model" => $editModel];
    }

    /**
     * @param $requestData
     * @return array
     */
    public static function listService($requestData): array
    {
        $page = key_exists("page", $requestData) ? $requestData["page"] : 0;
        $searchInput = key_exists("searchInput", $requestData) ? $requestData["searchInput"] : '';
        $listModel = new ListModel();
        $listModel->loadData($requestData);
        return [
            'model' => $listModel,
            'inscriptions' => Queries::searchLike($searchInput),
            "page" => $page,
            'searchInput' => $searchInput
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public static function profileService($id): array
    {
        $author = Queries::search("users", $id);
        $inscriptions = Queries::searchAllAuthors("inscriptions",$id);
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
    public static function postService(Request $request)
    {
        $postModel = new PostModel();
        if($request->isPost()){
            $postModel->loadData($request->getBody());
            if($postModel->store()){
                return ["post" => true, "model" => $postModel];
            }
        }
        return ["post" => false, "model" => $postModel];
    }


}