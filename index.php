<?php

use Controller\PageNotFound;

/*
 * Импорт всех классов
 */

/*
 * Абстрактные классы и классы namespace Helper
 */
include_once __DIR__ . "/controllers/Base.php";
include_once __DIR__ . "/models/Base.php";
include_once __DIR__ . "/core/View.php";

/*
 * SQL и классы ошибок
 */
include_once __DIR__ . "/core/sql.php";
include_once __DIR__ . "/core/exceptions/DbConnectionException.php";
include_once __DIR__ . "/core/exceptions/ForbiddenException.php";
include_once __DIR__ . "/core/exceptions/IllegalArgumentException.php";
include_once __DIR__ . "/core/exceptions/InvalidCredentialsException.php";

/*
 * Все модели
 */
include_once __DIR__ . "/models/Auth.php";
include_once __DIR__ . "/models/Index.php";

/*
 * Все контроллеры
 */
include_once __DIR__ . "/controllers/logout.php";
include_once __DIR__ . "/controllers/signup.php";
include_once __DIR__ . "/controllers/control_panel.php";
include_once __DIR__ . "/controllers/all_table.php";
include_once __DIR__ . "/controllers/auth.php";
include_once __DIR__ . "/controllers/competition.php";
include_once __DIR__ . "/controllers/index.php";
include_once __DIR__ . "/controllers/main_table.php";
include_once __DIR__ . "/controllers/PageNotFound.php";

$routes = explode('/', $_SERVER['SCRIPT_URL']);
$routes = array_filter($routes);
$routes = array_values($routes);

$controller = "\\Controller\\";
$controller .= empty($routes[0]) ? "index" : $routes[0];
$action = empty($routes[1]) ? "action_index" : "action_" . $routes[1];

// Если требуется обычный GET не из идиотского Web 2.0
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