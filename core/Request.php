<?php
namespace app\core;
class Request 
{

    public function method(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPath(){
        $path=$_SERVER["REQUEST_URI"]??'/';
        $position=stripos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
        
    }

    public function form(){
        $body=[];
        if ($this->method()=== 'get'){
            foreach ($_GET as $key => $value){
                $body[$key]= filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method()=== 'post'){
            foreach ($_POST as $key => $value){
                $body[$key]= filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
    public function isRequired($data){
        $message = false;
        if (empty(trim($data))){
            $message=true;
        }
        return $message;
    }
    public function isEmail($data){
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;

    }
    public function max($data, $max){

        if (strlen($data)>$max){

            return true;
        }
        return false;

    }
    public function min($data, $min){
        if (strlen($data)<$min){

            return true;
        }
        return false;

    }

    public function isUnique($table, $uniqueAtr, $value){
        try {
            $sql="SELECT * FROM $table WHERE $uniqueAtr = :$uniqueAtr ";
            $statement= Application::$app->db->pdo->prepare($sql);
            $statement->bindValue(":$uniqueAtr", $value);
            $statement->execute();

            return $statement->fetchObject();
        }catch (\PDOException $exception){
            echo Application::$app->router->renderView("_error", [
                'exception'=>$exception
            ]);
            exit();
        }

    }

    public  function validate(array $form, array $data=[]){
        $errors=[];

        foreach ($data as $key => $value){

            if (in_array('required', $value)){
                if($this->isRequired($form[$key])){
                    $errors[$key]['required']= $key. " Field is required";
                }
            }
            if (in_array('email', $value)){
                if (!$this->isRequired($form[$key])) {
                   if($this->isEmail($form[$key])){
                    $errors[$key]['email']= $key. " field does not contain a valid email";
                   }

                }

            }

            if (array_key_exists('min', $value)){
                if (!$this->isRequired($form[$key])) {
                    if($this->min($form[$key], $value['min'])){
                        $errors[$key]['min']= $key. " requires a minimum value of ".$value['min'];
                    }
                }
            }

            if (array_key_exists('max', $value)){
               if($this->max($form[$key], $value['max'])){
                   $errors[$key]['max']= $key. " requires a maximum value of ".$value['max'];
               }

            }
            if (array_key_exists('unique', $value)){
                $params= explode(':', $value['unique']);
                $table= $params[1];
                $uniqueAtr= $params[0];

                if($this->isUnique($table, $uniqueAtr, $form[$key])){
                    $errors[$key]['unique']= $key. " already exist";
                }

            }

        }

        return $errors;
    }


}
