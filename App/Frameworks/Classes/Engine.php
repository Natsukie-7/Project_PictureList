<?php

namespace App\Frameworks\Classes;

use Exception;

class Engine
{
    private function getUser()
    {
        return [
            "name" => "nathan",
            "age" => 18
        ];
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

        return $content;
    }
}