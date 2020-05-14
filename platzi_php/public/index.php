<?php

ini_set('display_errors',1);
ini_set('display_starup_error',1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cursophp',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
$map->get('index', '/platzi_php/', [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'indexAction'
]);

$map->get('addJob', '/platzi_php/jobs/add', [
    'controller' => 'App\Controllers\JobController',
    'action' => 'getAddJobAction'
]);

$map->post('saveJob', '/platzi_php/jobs/add', [
    'controller' => 'App\Controllers\JobController',
    'action' => 'getAddJobAction'
]);

$map->get('addProject', '/platzi_php/projects/add', [
    'controller' => 'App\Controllers\ProjectController',
    'action' => 'getAddProjectAction'
]);

$map->post('saveProject', '/platzi_php/projects/add', [
    'controller' => 'App\Controllers\ProjectController',
    'action' => 'getAddProjectAction'
]);

$map->get('addUser', '/platzi_php/users/add', [
    'controller' => 'App\Controllers\UserController',
    'action' => 'getAddUserAction'
]);

$map->post('saveUser', '/platzi_php/users/add', [
    'controller' => 'App\Controllers\UserController',
    'action' => 'getAddUserAction'
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if(!$route){
    echo 'No route';
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];

    $controller = new $controllerName;
    $response = $controller->$actionName($request);
    // require $route->handler;

    echo $response->getBody();
};

// var_dump($route);

