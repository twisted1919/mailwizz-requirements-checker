<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('MW_NAME', 'MailWizz EMA');
define('MW_VERSION', '1.0');

define('MW_INSTALLER_PATH', realpath(dirname(__FILE__)));
define('MW_ASSETS_SERVER', 'http://www.mailwizz.com');

require_once MW_INSTALLER_PATH . '/inc/functions.php';
require_once MW_INSTALLER_PATH . '/inc/Controller.php';

$route = getQuery('route');

if (empty($route)) {
    $route = 'requirements';
}

$route = str_replace(array('../', '..'), '', $route);

$controller = $action = null;

if (strpos($route, '/') !== false) {
    $routeParts = explode('/', $route);
    $routeParts = array_slice($routeParts, 0, 2);
    list($controller, $action) = $routeParts;
} else {
    $controller = $route;
}

$controller = formatController($controller);
if (!empty($action)) {
    $action = formatAction($action);
}

if (!is_file($controllerFile = MW_INSTALLER_PATH . '/controllers/' . $controller . '.php')) {
    $controller = formatController('requirements');
    $controllerFile = MW_INSTALLER_PATH . '/controllers/' . $controller . '.php';
}

require_once $controllerFile;
$controller = new $controller();

if (empty($action)) {
    $action = 'actionIndex';
} elseif (!method_exists($controller, $action)) {
    $action = 'actionNot_found';
}

$controller->$action();