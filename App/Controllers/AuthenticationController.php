<?php

namespace App\Controllers;

use App\Frameworks\Database\Connection;

class AuthenticationController
{
    public function renderLoginView()
    {
        view("Login");
    }

    public function renderRegisterView()
    {

        view("Register");
    }

    public function loginAuthentication()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (!$email || !$password) {
            echo json_encode(["message" => "Email and password are required"]);
            return;
        }

        $stmt = Connection::getInstance()->prepare("SELECT * FROM users us 
            INNER JOIN accounts acc ON us.id = acc.id 
            WHERE acc.email = :email AND acc.password = :password");

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch();

        $_SESSION["logged"] = true;
        unset($user->password);
        $_SESSION["user"] = $user;

        echo json_encode($user ? ["message" => "Login successful", "user" => $user] : ["message" => "Invalid email or password"]);
    }

    public function logout()
    {
        // Verifica se o usuário está logado
        if (isset($_SESSION["logged"]) && $_SESSION["logged"] === true) {
            // Destruir as variáveis de sessão
            unset($_SESSION["logged"]);
            unset($_SESSION["user"]);
            
            // Resposta JSON confirmando o logout
            echo json_encode(["message" => "Logout successful"]);
        } else {
            // Caso o usuário não esteja logado
            echo json_encode(["message" => "No active session found"]);
        }

        redirect("/login");
    }
}