<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        $data = ["name" => "nathan"];

        view("Home", $data);
    }
}