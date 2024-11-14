<?php

namespace App\Frameworks\Classes;

use Exception;

class Router
{
    private string $path;
    private string $request;

    public function execute(array $routes)
    {
        $this->path = path();
        $this->request = request();

        $this->routerFound($routes);

        [$controller, $action] = explode("@", $routes[$this->request][$this->path]);

        if (str_contains($action, ":")) {
            [$action, $setting] = explode(':', $action);
        }

        if (!$setting || $setting !== "public") {
            $isAuthorized = $this->validateAuth();

            if (!$isAuthorized) {
                return redirect("/login");
            }
        }

        $controllerNamespace = "App\\Controllers\\$controller";

        $this->controllerFound($controllerNamespace, $controller, $action);
        
        $controllerInstance = new $controllerNamespace;
        $controllerInstance->$action();
    }
    private function routerFound(array $routes)
    {
        if (!isset($routes[$this->request])) {
            throw new Exception("O método de requisição << $this->request >> não existe");
        }

        if (!isset($routes[$this->request][$this->path])) {
            throw new Exception("O caminho da rota << $this->path >> não existe");
        }
    }

    private function controllerFound(string $controllerNamespace, string $controller, string $action)
    {
        if (!class_exists($controllerNamespace)) {
            throw new Exception("O controller $controller não existe");
        }

        if (!method_exists($controllerNamespace, $action)) {
            throw new Exception("Não existe a o methodo $action na classe $controller");
        }
    }

    private function validateAuth()
    {
        return isset($_SESSION["logged"]);
    }
}