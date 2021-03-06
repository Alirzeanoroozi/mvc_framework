<?php

namespace Alireza\Untitled\service;

use Alireza\Untitled\core\Application;

class Queries
{
    /**
     * @param $tableName
     * @param $id
     * @return mixed
     */
    public static function search($tableName, $id)
    {
        $statement = Application::$app->db->pdo->prepare("Select * from $tableName where id=$id");
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * @param $tableName
     * @param $id
     * @return void
     */
    public static function delete($tableName, $id): void
    {
        $statement = Application::$app->db->pdo->prepare("DELETE from $tableName where id=$id");
        $statement->execute();
    }

    /**
     * @param $tableName
     * @param $id
     * @return array|false
     */
    public static function searchAllAuthors($tableName, $id)
    {
        $statement_ins = Application::$app->db->pdo->prepare("Select * from $tableName where author_id=$id");
        $statement_ins->execute();
        return $statement_ins->fetchALL();
    }

    /**
     * @param $text
     * @return bool|array
     */
    public static function searchLike($text)
    {
        $statement = Application::$app->db->pdo->prepare(
            "Select * from
                inscriptions JOIN users
                ON inscriptions.author_id=users.id
                where (subject LIKE Binary '%$text%' OR content LIKE Binary '%$text%' OR firstname LIKE Binary '%$text%');");
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @param $editModel
     * @return void
     */
    public static function update($editModel): void
    {
        $statement  = Application::$app->db->pdo->prepare("UPDATE inscriptions SET content = '$editModel->content', subject = '$editModel->subject' Where id = '$editModel->id'");
        $statement->execute();
    }

}