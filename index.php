<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_DIR', __DIR__);

$config = include 'app/config.php';

$controller = 'book';
$action = 'index';

if (isset($_REQUEST['route'])) {
    $route = explode('.', $_REQUEST['route']);

    if (! empty($route[0])) {
        $controller = $route[0];
    }

    if (! empty($route[1])) {
        $action = $route[1];
    }
}

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = BASE_DIR . "/app/Controllers/Library/{$controllerName}.php";
if (! file_exists($controllerFile)) {
    exit('404 Not found');
}

require_once $controllerFile;
$controllerInstance = new $controllerName;

if (! method_exists($controllerInstance, $action)) {
    exit('404 Not found');
}

echo $controllerInstance->$action();

