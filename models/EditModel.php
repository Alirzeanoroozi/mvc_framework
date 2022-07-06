<?php

namespace Alireza\Untitled\models;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\DBModel;

class EditModel extends DBModel
{
    public int $id = 0;
    public string $subject = "";
    public string $content = "";
    public int $userId = 0;
    public int $inscriptionAuthorId = 0;

    public function fillData()
    {
        $this->userId = Application::$app->session->get('user');
        $statement  = Application::$app->db->pdo->prepare("Select * from inscriptions where id='$this->id'");
        $statement->execute();
        $inscription = $statement->fetch();
        $this->subject = $inscription["subject"];
        $this->inscriptionAuthorId = $inscription["author_id"];
        $this->content = $inscription["content"];
    }

    public function rules()
    {
        return [];
    }

    public function label() : array
    {
        return [
            'subject' => 'Subject',
            'content' => 'Your Content'
        ];
    }

    public function tableName(): string
    {
        return 'inscriptions';
    }

    public function attributes(): array
    {
        return ['subject', 'content'];
    }

    static public function primaryKey(): string
    {
        return 'id';
    }

    public function update()
    {
        $statement  = Application::$app->db->pdo->prepare("UPDATE inscriptions SET content = '$this->content', subject = '$this->subject' Where id = '$this->id'");
        $statement->execute();
        return true;
    }

}