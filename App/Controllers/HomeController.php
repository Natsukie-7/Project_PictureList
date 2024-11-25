<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        $data = ["title" => "Home"];

        view("Home", $data);
    }
}