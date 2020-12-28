<?php
namespace app\core;
use app\controllers\Controller;
use Exception;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Controller $controller;
    public Database $db;
    public static Application $app;
    public function __construct($rootdir, $config) {
        self::$ROOT_DIR=$rootdir;
        self::$app=$this;
        $this->request = new Request();
        $this->response= new Response();
        $this->session= new Session();
        $this->router= new Router($this->request);
        $this->db= new Database($config);

        // var_dump($this->controller);
        
    }

    public function run(){
        try {
            echo $this->router->resolve();
        }catch (Exception $exception){
            Application::$app->response->setStatusCode($exception->getCode());
            echo $this->router->renderView('_error', [
                'exception'=>$exception
            ]);
        }

    }

}
