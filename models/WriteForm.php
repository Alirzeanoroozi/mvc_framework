<?php

namespace Alireza\Untitled\models;

use Alireza\Untitled\core\Application;
use Alireza\Untitled\core\DBModel;

class WriteForm extends DBModel
{
    public string $subject = "";
    public string $content = "";
    public int $author_id = 0;


    public function __construct()
    {
        $this->author_id = Application::$app->session->get('user');;
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
        return ['subject', 'author_id', 'content'];
    }

    static public function primaryKey(): string
    {
        return 'id';
    }

    public function store()
    {
        return parent::save();
    }
}