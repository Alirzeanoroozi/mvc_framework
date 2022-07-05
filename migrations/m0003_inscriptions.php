<?php

use Alireza\Untitled\core\Application;

class m0003_inscriptions
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE inscriptions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                subject VARCHAR(255) NOT NULL,
                author_id INT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                foreign key(author_id) REFERENCES users(id)
            )";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE inscriptions;";
        $db->pdo->exec($SQL);
    }
}