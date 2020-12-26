<?php

 $db = array([
    'dbname'=>$_ENV["DBN_NAME"],
    'host'=>$_ENV["DB_HOST"],
    'port'=>$_ENV["DB_PORT"],
    'username'=>$_ENV["DB_USERNAME"],
    'password'=>$_ENV["DB_PASSWORD"]

]);

 return $db;