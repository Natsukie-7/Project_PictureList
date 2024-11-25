<?php

namespace App\Frameworks\Classes;

class Macros
{
    public function cssEnv(string $fileName)
    {
        echo "Assets/Css/$fileName.css";
    }

    public function requestJsScript(string $fileName)
    {
        echo "Assets/Js/$fileName.js";
    }

    public function requestFile(string $fileName)
    {
        echo "Assets/Imgs/$fileName";
    }

    public function isArtist($get)
    {
        return $_SESSION["user"]["isArtist"] == 1;
    }
}