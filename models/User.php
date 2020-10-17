<?php


namespace app\models;


use app\core\Model;

class User extends Model
{
    public array $fillables;
    public string $table='users';




    public function save(){
        return $this->add($this->fillables, $this->table);
    }







}