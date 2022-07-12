<?php

namespace Alireza\Untitled\models;

class ListModel extends Model
{
    public string $searchInput = "";

    public function rules() :array
    {
        return [];
    }

    public function label() : array
    {
        return ['searchInput' => 'What are you looking for?'];
    }
}