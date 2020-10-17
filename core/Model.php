<?php


namespace app\core;






class Model
{
    public function add($datas, $table){
        $column=[];
        $data=[];
        foreach ($datas as $key=>$value){
            $column[]=$key;
            $data[":$key"]=$value;
        }

        $params= array_map(fn($atr)=> ":$atr", $column);
        $statement="INSERT INTO $table (".implode(',',$column).")VALUES(".implode(",",$params).")";
        $query= self::prepare($statement);
        foreach ($data as $key => $value){
            $query->bindValue($key, $value);
        }
        $query->execute();
        return true;

    }

    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }

    public function hash($password){
       return password_hash($password, PASSWORD_DEFAULT);

    }

    public function findOne($table, $datas){
        $column=[];
        $data=[];
        foreach ($datas as $key=>$value){
            $column[]=$key."= :".$key;
            $data[":$key"]=$value;
        }

        $statement=Application::$app->db->pdo->prepare(
            "SELECT * FROM $table WHERE ".implode("AND",$column));
        foreach ($data as $key => $value){
            $statement->bindValue($key, $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }




}