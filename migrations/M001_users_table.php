<?php

use app\core\Application;

class M001_users_table
{
    public function up(){
        $db=Application::$app->db;
        $sql="CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR (225),
            firstname VARCHAR (225),
            lastname VARCHAR (225),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ) ENGINE=INNODB";
        $db->pdo->exec($sql);
    }

    public function drop(){
        $db=Application::$app->db;
        $sql="DROP TABLE users";
        $db->pdo->exec($sql);
    }

}
