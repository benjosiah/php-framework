<?php


use app\core\Application;

class M002_edit_users_table
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "ALTER TABLE users ADD COLUMN 
                password VARCHAR (512) NOT NULL ";
        $db->pdo->exec($sql);
    }

    public function drop()
    {
        $db = Application::$app->db;
        $sql = "ALTER TABLE users DROP COLUMN password";
        $db->pdo->exec($sql);
    }

}
