<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        $data = ["user" => $_SESSION["user"]];

        view("Home", $data);
    }
}