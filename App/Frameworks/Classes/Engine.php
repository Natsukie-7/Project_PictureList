<?php

namespace App\Frameworks\Classes;

use Exception;
use ReflectionClass;

class Engine
{
    private ?string $layout;
    private string $content;
    private array $data;
    private array $dependecies;

    private function load()
    {
        return !empty($this->content) ? $this->content : "";
    }

    private function extends(string $layout, array $data = [])
    {
        $this->layout = $layout;
        $this->data = $data;
    }

    public function dependecies(array $dependencies) {
        foreach ($dependencies as $dependencie) {
            $className = strtolower((new ReflectionClass($dependencie))->getShortName());
            $this->dependecies[$className] = $dependencie;
        }
    }

    public function __call(string $name, array $params)
    {
        if (!method_exists($this->dependecies['macros'], $name)) {
            throw new Exception("Macro doesn't exists");
        }

        if (empty($params)) {
            throw new Exception("Method $name need one paramenters");
        }

        return $this->dependecies['macros']->$name($params[0]);
    }

    public function render(string $view, array $data)
    {
        $view = dirname(__FILE__, 2) . "/Resources/Views/$view.php";

        if (!file_exists($view)) {
            throw new Exception("Caminho para viewport $view não encontrado");
        }

        ob_start();

        extract($data);

        require $view;

        $content = ob_get_contents();

        ob_end_clean();

        if (!empty($this->layout)) {
            $this->content = $content;
            $data = array_merge($this->data, $data);
            $layout = $this->layout;
            $this->layout = null;
            return $this->render($layout, $data);
        }

        return $content;
    }
}