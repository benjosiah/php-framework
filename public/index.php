<?php
require_once __DIR__ . "/../vendor/autoload.php";
use app\core\Application;
use app\controllers\SiteController;
use app\core\Auth;
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
require_once __DIR__. "/../config/dbconfig.php";
$app = new Application(dirname(__DIR__), $db);
var_dump($_ENV);
 require_once __DIR__. "/../Route.php";

//$app->router->get('/user', [SiteController::class, 'user']);
//$app->router->get('/', [SiteController::class, 'home']);
//$app->router->get('/contact', [SiteController::class, 'contact']);
//$app->router->post('/contact', [SiteController::class, 'submitContact']);
//$app->router->post('/user', [SiteController::class, 'register']);
//$app->router->get('/logout', [SiteController::class, 'logout']);


$app->run();

