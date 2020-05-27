<?php

include_once __DIR__ . "/core/Controller.php";
include_once __DIR__ . "/core/View.php";
include_once __DIR__ . "/core/Model.php";

error_reporting(E_ALL & ~E_NOTICE);

$explode = explode('/', $_SERVER['REDIRECT_URL']);

if (!is_null($explode[1])) $controller = strtolower($explode[1]);
if (!is_null($explode[2]) && !empty($explode[2]))
    $action = strtolower("action_" . $explode[2]);
else
    $action = "action_index";

if (count($explode) < 2) {
    include_once __DIR__ . "/controllers/Index.php";
    $controller = "Index";
}

// Если требуется обычный GET не из Web 2.0
if (count($explode) >= 3) {
    $params = array_slice($explode, 3, count($explode));
} // else {
//    $params = $_GET;
//}

if (!file_exists(__DIR__ . "/controllers/" . $controller . ".php") && $controller !== "index") {
    include_once __DIR__ . "/controllers/PageNotFound.php";
    $controller = "PageNotFound";
} else {
    include_once __DIR__ . "/controllers/" . $controller . ".php";
}

$Controller = new $controller();

if (!method_exists($Controller, $action)) $Controller->method_not_found();

$Controller->$action($params);