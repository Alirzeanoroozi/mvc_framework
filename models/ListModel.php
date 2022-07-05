<?php

namespace Alireza\Untitled\models;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\Model;

class ListModel extends Model
{
    public string $author_name = "";
    public string $subject = "";
    public int $inscription_id = 0;
    public int $author_id = 0;

    public function rules()
    {
        return [];
    }

    public function label() : array
    {
        return [
            'author_name' => 'Search by first name of author',
            'subject' => 'Search by subject',
            'inscription_id' => 'Search by id of inscription',
            'author_id' => 'Search by id of author'
        ];
    }

    public function search()
    {
        $user = (new User)->findOne(['email' => $this->email]);
        if(!$user){
            $this->addError('email', 'User Does Not Exists');
            return false;
        }

        if(!password_verify($this->password, $user->password)){
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }



    public static function print()
    {
        $statement = Application::$app->db->pdo->prepare("Select * from inscriptions");
        $statement->execute();
        $outputText = '<table border=\'1\' cellpadding=\'15\'><thead><tr><th><h1>id</h1></th><th><h1>Subject</h1></th><th><h1>Author</h1></th><th><h1>Content</h1></th><th><h1>Actions</h1></th></tr></thead><tbody>';
        foreach ($statement->fetchAll() as $inscription){
            $author = (new User)->findOne([User::primaryKey()=>$inscription["author_id"]]);
            $id = $inscription["id"];
            $outputText = $outputText. '<tr><th>'. $inscription["id"]. '</th><th>'. $inscription["subject"]. '</th><th>'. $author->firstname. '</th><th>'. $inscription["content"]. '</th><th>'. "<a href=\"view?id=$id\">View</a><a href=\"edit?id=$id\">Edit</a><a href=\"delete?id=$id\">Delete</a>". '</th></tr>';
        }
        return $outputText."</tbody></table>";
    }
}