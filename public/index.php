<?php
require_once __DIR__ . "/../vendor/autoload.php";
use app\core\Application;
use app\controllers\SiteController;
use app\core\Auth;

$app = new Application(dirname(__DIR__));

 require_once __DIR__. "/../Route.php";

//$app->router->get('/user', [SiteController::class, 'user']);
//$app->router->get('/', [SiteController::class, 'home']);
//$app->router->get('/contact', [SiteController::class, 'contact']);
//$app->router->post('/contact', [SiteController::class, 'submitContact']);
//$app->router->post('/user', [SiteController::class, 'register']);
//$app->router->get('/logout', [SiteController::class, 'logout']);


$app->run();

