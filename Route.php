<?php
use app\controllers\SiteController;
/**
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */


$app->router->get('/user', [SiteController::class, 'user']);
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'submitContact']);
$app->router->post('/user', [SiteController::class, 'register']);
$app->router->get('/logout', [SiteController::class, 'logout']);