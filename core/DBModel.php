<?php
namespace Alireza\Untitled\core;
abstract class DBModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract static public function primaryKey(): string;

    public function save(){
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement  = Application::$app->db->pdo->prepare("Insert into $tableName (".implode(',', $attributes).") values (".implode(',', $params).")");
        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public function findOne($where)
    {
        $tableName = $this->tableName();
        $attributes = array_keys($where);
        $sql = implode('And ', array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement  = Application::$app->db->pdo->prepare("Select * from $tableName where $sql");
        foreach ($where as $key => $item){
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

}