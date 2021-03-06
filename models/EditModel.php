<?php

namespace Alireza\Untitled\models;

class EditModel extends DBModel
{
    public int $id = 0;
    public string $subject = "";
    public string $content = "";
    public int $inscriptionAuthorId = 0;

    public function fillData($inscription)
    {
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
}