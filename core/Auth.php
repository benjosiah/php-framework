<?php


namespace app\core;




class Auth

{
    public Model $model;

    public function __construct()
    {
        $this->model= new Model();
    }
    public function make($table, $data){
        $user=$this->model->findOne($table, $data);
        Application::$app->session->setAuthUser($user);
        return $user;
    }

    public static function user(){
        return $_SESSION['auth_user'];
    }

    public static function isAuth(){
        return $_SESSION['auth_user']!==null;
    }

    public function logOut(){
        Application::$app->session->removeUser();

    }


}