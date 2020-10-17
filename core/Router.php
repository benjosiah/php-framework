<?php
namespace app\core;

use app\controllers\Controller;
use app\core\exception\NotFoundExection;

class Router
{
    protected array $routes = array();
    public Request $request;

    public function __construct($request) {
        $this->request = $request;
    }

    public function get($path, $callback){
        $this->routes['get'][$path]=$callback;
    }
    public function post($path, $callback){
        $this->routes['post'][$path]=$callback;
    }

    public function resolve(){
        $path= $this->request->getPath();
        $method= $this->request->method();
        $callback= $this->routes[$method][$path] ?? null;
        if($callback === null){
            throw new NotFoundExection();

        }
        if (is_string($callback)){
            return $this->renderView($callback);
        }
        if (is_array($callback)){
            /** @var Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller=$controller;
            $controller->action= $callback[1];
            $callback[0]= $controller;
            foreach ($controller->getMiddlewares() as $middleware){
//                var_dump($middleware->execute());
                $middleware->execute();
            }
            
        }
        return call_user_func($callback, $this->request);
    }

    public function renderView(string $callback, $params=[])
    {
        $layout=$this->layoutContent();
        $view= $this->viewContent($callback, $params);
        if ($layout==""){
            return $view;
        }
        return str_replace('{{content}}', $view, $layout);

    }

    public function layoutContent()
    {
        $layout= Application::$app->controller->layout??"";
        if ($layout==""){

            return $layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/view/layout/$layout.php";
        return ob_get_clean();
    }
    public function viewContent($view, $params){

        foreach ($params as $key=>$value){
            $$key= $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/view/$view.php";
        return ob_get_clean();
    }




}
