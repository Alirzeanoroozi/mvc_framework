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

    public function rules() :array
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
        $statement = Application::$app->db->pdo->prepare("Select * from inscriptions");
        $statement->execute();
        $allQueries = $statement->fetchAll();
        $searchQueries = [];

        //name of author
        if($this->author_name != ""){
            foreach($allQueries as $query){
                $author = (new User)->findOne([User::primaryKey()=>$query["author_id"]]);
                if ($author->firstname == $this->author_name){
                    $searchQueries[] = $query;
                }
            }
            $allQueries = $searchQueries;
            $searchQueries = [];
        }
        //subject
        if($this->subject != ""){
            foreach($allQueries as $query){
                if ($query["subject"] == $this->subject){
                    $searchQueries[] = $query;
                }
            }
            $allQueries = $searchQueries;
            $searchQueries = [];
        }
        //id_inscription
        if($this->inscription_id !== 0){
            foreach($allQueries as $query){
                if ($query["id"] === $this->inscription_id){
                    $searchQueries[] = $query;
                }
            }
            $allQueries = $searchQueries;
            $searchQueries = [];
        }
        //author_id
        if($this->author_id != 0){
            foreach($allQueries as $query){
                if ($query["author_id"] == $this->author_id){
                    $searchQueries[] = $query;
                }
            }
            $allQueries = $searchQueries;
        }
        $outputText = '<table border=\'1\' cellpadding=\'15\'><thead><tr><th><h1>id</h1></th><th><h1>Subject</h1></th><th><h1>Author</h1></th><th><h1>Content</h1></th><th><h1>Actions</h1></th></tr></thead><tbody>';
        foreach ($allQueries as $inscription){
            $author = (new User)->findOne([User::primaryKey()=>$inscription["author_id"]]);
            $id = $inscription["id"];
            $author_id = $inscription["author_id"];
            $outputText = $outputText. '<tr><th>'. $inscription["id"]. '</th><th>'. $inscription["subject"]. '</th><th><a href="/profile?=$author_id">'. $author->firstname. '</a></th><th>'. $inscription["content"]. '</th><th>'. "<a href=\"view?id=$id\">View</a><a href=\"edit?id=$id\">Edit</a><a href=\"delete?id=$id\">Delete</a>". '</th></tr>';
        }
        return $outputText."</tbody></table>";
    }

}