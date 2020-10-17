<?php


namespace app\controllers;


use app\core\Application;
use app\core\Auth;
use app\core\middlewares\BaseMiddleware;
use app\core\Model;


class Controller extends Model
{
    public string $layout="main";
    public $action="";
    /**
     * @var array \app\core\midlewares\BaseMiddleware[]
     */
    protected array $middlewares=[];

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
    
    public function auth(){
        return new Auth();
    }
    public function encrypt($password){
        return $this->hash($password);
    }
    public function render($callback, $params=[]){
        return Application::$app->router->renderView($callback, $params);
    }
    public function redirect($path)
    {
        header("location: $path");
    }
    public function setLayout(string $layout)
    {
        $this->layout= $layout;
    }
    public function registerMiddleware(BaseMiddleware $baseMiddleware){
        $this->middlewares[]=$baseMiddleware;
    }

    


}