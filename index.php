<?php

use Controller\PageNotFound;

include_once __DIR__ . "/controllers/Base.php";
include_once __DIR__ . "/models/Base.php";
include_once __DIR__ . "/core/View.php";

include_once __DIR__ . "/core/sql.php";
include_once __DIR__ . "/core/exceptions/DbConnectionException.php";

include_once __DIR__ . "/models/Auth.php";
include_once __DIR__ . "/models/Index.php";

include_once __DIR__ . "/controllers/index.php";
include_once __DIR__ . "/controllers/PageNotFound.php";
include_once __DIR__ . "/controllers/auth.php";

$routes = explode('/', $_SERVER['SCRIPT_URL']);
$routes = array_filter($routes);
$routes = array_values($routes);

$controller = "\\Controller\\";
$controller .= empty($routes[0]) ? "index" : $routes[0];
$action = empty($routes[1]) ? "action_index" : "action_" . $routes[1];

// Если требуется обычный GET не из Web 2.0
if (count($routes) >= 3) {
    $params = array_slice($routes, 3, count($routes));
} else {
    $params = $_GET;
}

try {
    $controller = new $controller();
} catch (Throwable $exception) {
    $controller = new PageNotFound();
}

if (!method_exists($controller, $action)) $controller->method_not_found();

$controller->$action($params);