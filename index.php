<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$controller = isset($_GET['c']) ? $_GET['c'] : 'login';
$action     = isset($_GET['a']) ? $_GET['a'] : 'index';

// Protección de rutas (solo login libre)
if (!isset($_SESSION['usuario']) && $controller != 'login') {
    header("Location: index.php?c=login&a=index");
    exit;
}

$controllerName = ucfirst(strtolower($controller)) . 'Controller';
$controllerFile = "controllers/{$controllerName}.php";

if (!file_exists($controllerFile)) {
    die("❌ Error: El controlador <b>{$controllerName}</b> no existe.");
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    die("❌ Error: La clase del controlador <b>{$controllerName}</b> no está definida.");
}

$controllerInstance = new $controllerName();

if (!method_exists($controllerInstance, $action)) {
    die("❌ Error: La acción <b>{$action}</b> no está definida en el controlador <b>{$controllerName}</b>.");
}

$controllerInstance->$action();
