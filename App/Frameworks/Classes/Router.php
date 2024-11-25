<?php

namespace App\Frameworks\Classes;

use Exception;

class Router
{
    private string $path;
    private string $request;
    private ?int $idParam;

    public function execute(array $routes)
    {
        $this->path = path();
        $this->request = request();

        // Verifica se a rota existe
        $this->routerFound($routes);

        [$controller, $action] = explode("@", $routes[$this->request][$this->path]);

        // Verifica se há configurações específicas na ação
        $setting = null;
        if (str_contains($action, ":")) {
            [$action, $setting] = explode(':', $action);
        }

        // Valida autenticação se a rota não for pública
        if (!$this->isPublic($setting)) {
            if (!$this->validateAuth()) {
                return redirect("/login");
            }
        }

        $controllerNamespace = "App\\Controllers\\$controller";

        // Garante que o controlador existe
        $this->controllerFound($controllerNamespace, $controller, $action);

        // Instancia o controlador e chama a ação
        $controllerInstance = new $controllerNamespace;
        
        isset($this->idParam) 
            ? $controllerInstance->$action($this->idParam)
            : $controllerInstance->$action();
    }
    private function routerFound(array $routes)
    {
        if (!isset($routes[$this->request])) {
            throw new Exception("O método de requisição << $this->request >> não existe");
        }

        if (str_contains($this->path, '?')) {
            [$this->path, $params] = explode('?', $this->path);
            $this->idParam = $params ?? null;
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
        return isset($_SESSION["isLogged"]);
    }

    private function isPublic(?string $setting): bool
    {
        return $setting === "public";
    }
}