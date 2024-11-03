<?php

namespace App\Controllers;

class AuthenticationController
{
    public function renderLoginView()
    {
        $data = ["name" => "nathan"];

        view("Login", $data);
    }
}