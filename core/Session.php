<?php


namespace app\core;


class Session
{
    const AUTH_USER='auth_user';

    function __construct()
    {
        session_start();
        $authUser=$_SESSION[self::AUTH_USER]??null;
        $_SESSION[self::AUTH_USER]=$authUser;
    }

    public function setAuthUser( $user){
        $_SESSION[self::AUTH_USER]=$user;

    }

    public function removeUser(){
        $_SESSION[self::AUTH_USER]=null;
    }




}