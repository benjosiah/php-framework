<?php


namespace app\core;

use PDO;

class Database
{
    public  PDO $pdo;

    public function __construct()
    {
        $dsn='mysql:host=localhost;dbname=mvc_framework';
        $usernme='root';
        $password='';
        $this->pdo= new PDO($dsn, $usernme, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function applyMigration(){
        $newMigrations=[];
        $this->createMigrationsTable();
        $applied=$this->appliedMigrations();
        $files=scandir(Application::$ROOT_DIR."/migrations");
        $notApplied=array_diff($files, $applied);

        foreach ($notApplied as $migration){
            if ($migration=='.'||$migration=='..'){
                continue;
            }
            include_once Application::$ROOT_DIR. "/migrations/$migration";

            $className=pathinfo($migration, PATHINFO_FILENAME);

            $initiate= new $className();
            $this->log("Migrating $migration");
            $initiate->up();
            $this->log("migrated $migration");
            $newMigrations[]=$migration;
        }
        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }
        else{
            $this->log("All migrations are applied");
        }


    }


    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR (225),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ) ENGINE=INNODB");
    }

    public function appliedMigrations()
    {
        $statement= $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $newMigrations)
    {
        $str= implode(',',array_map(fn($m)=>"('$m')", $newMigrations));
        $statement=$this->pdo->prepare("INSERT INTO migrations (migration) VALUES  $str ")  ;
        $statement->execute();

    }

    protected function log(string $string)
    {
        echo "[".date('Y-m-d H:i:s')."] - ".$string . PHP_EOL;
    }


}