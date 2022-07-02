<?php

namespace Alireza\Untitled\core;

use PDO;
use PDOException;

class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';


        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(__DIR__."//..//migrations");
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..'){
                continue;
            }

            require_once __DIR__."\\..\\migrations\\".$migration;

            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance  = new $className();
            echo "Applying migration $migration".PHP_EOL;
            $instance->up();
            echo "Applied migration $migration".PHP_EOL;
            $newMigrations[] = $migration;

        }

        if (!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        } else{
            echo "All migrations are applied";
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("Create Table if Not EXISTS migrations(
                                    id int auto_increment primary key,
                                    migration varchar(255),
                                    created_at TIMESTAMP Default Current_Timestamp) 
                                ;");
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    private function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration From migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    private function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str")->execute();
    }
}