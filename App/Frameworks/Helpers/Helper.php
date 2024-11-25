<?php

use App\Frameworks\Classes\Engine;
use App\Frameworks\Classes\Macros;
use App\Frameworks\Classes\Router;

function path()
{
    return $_SERVER["REQUEST_URI"];
};

function request()
{
    return strtolower($_SERVER["REQUEST_METHOD"]);
}

function routerExecute()
{
    try {
        $routes = require "../App/Routes/Routes.php";
        $router = New Router;

        $router->execute($routes);
    } catch (\Throwable $err) {
        var_export($err->getMessage());
    }
}

function view(string $view, ?array $data = [])
{
    try {
        $engine = new Engine;
        $engine->dependecies([new Macros]);
        echo $engine->render($view, $data);
    } catch (\Throwable $err) {
        var_export($err->getMessage());
    }
}

function redirect(string $destiny)
{
    header("Location: $destiny");
    exit;
}