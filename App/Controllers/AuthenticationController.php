<?php

namespace App\Controllers;

use App\Frameworks\Database\Connection;
use PDO;

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

        $stmt = Connection::getInstance()->prepare("SELECT
                us.id AS user_id,
                us.name AS user_name,
                acc.email AS user_email,
                CASE 
                    WHEN art.id IS NOT NULL THEN 1 
                    ELSE 0 
                END AS is_artist
            FROM users us
            INNER JOIN accounts acc ON us.id = acc.fk_user_id
            LEFT JOIN artists art ON us.id = art.fk_user_id
            WHERE acc.email = :email
            AND acc.password = :password"
        );

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Use fetch(PDO::FETCH_ASSOC) to get an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION["isLogged"] = true;

        if ($user) {
            $_SESSION["user"] = [
                "userId" => $user['user_id'],
                "userName" => $user['user_name'],
                "userEmail" => $user['user_email'],
                "isArtist" => (bool) $user['is_artist']
            ];

            echo json_encode(["message" => "Login successful", "user" => $user]);
        } else {
            echo json_encode(["message" => "Invalid email or password"]);
        }
    }

    
    public function registerUser()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
    
        $name = $data['nome'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['senha'] ?? null;
        $isArtist = isset($data['artista']) && $data['artista'] === 'sim' ? 1 : 0;
    
        // Verificação de campos obrigatórios
        if (!$name || !$email || !$password) {
            http_response_code(400); // Código HTTP 400: Bad Request
            echo json_encode(["message" => "Nome, email e senha são obrigatórios"]);
            return;
        }
    
        try {
            // Inicia uma transação para garantir consistência nos dados
            $connection = Connection::getInstance();
            $connection->beginTransaction();
    
            // Inserir na tabela `users`
            $stmtUser = $connection->prepare("INSERT INTO users (name) VALUES (:name)");
            $stmtUser->bindParam(':name', $name);
            $stmtUser->execute();
            $userId = $connection->lastInsertId();
    
            // Inserir na tabela `accounts`
            $stmtAccount = $connection->prepare("
                INSERT INTO accounts (fk_user_id, email, password) 
                VALUES (:fk_user_id, :email, :password)"
            );
            $stmtAccount->bindParam(':fk_user_id', $userId);
            $stmtAccount->bindParam(':email', $email);
            $stmtAccount->bindParam(':password', $password);
            $stmtAccount->execute();
    
            // Inserir na tabela `artists` se o usuário for um artista
            if ($isArtist) {
                $stmtArtist = $connection->prepare("
                    INSERT INTO artists (fk_user_id) 
                    VALUES (:fk_user_id)"
                );
                $stmtArtist->bindParam(':fk_user_id', $userId);
                $stmtArtist->execute();
            }
    
            // Confirma a transação
            $connection->commit();
    
            // Recupera os dados do usuário com FETCH_ASSOC para garantir um array
            $stmt = Connection::getInstance()->prepare("SELECT
                us.id AS user_id,
                us.name AS user_name,
                acc.email AS user_email,
                CASE 
                    WHEN art.id IS NOT NULL THEN 1 
                    ELSE 0 
                END AS is_artist
            FROM users us
            INNER JOIN accounts acc ON us.id = acc.fk_user_id
            LEFT JOIN artists art ON us.id = art.fk_user_id
            WHERE acc.email = :email
            AND acc.password = :password"
            );
    
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);  // Aqui foi adicionado o FETCH_ASSOC
    
            $_SESSION["isLogged"] = true;
            $_SESSION["user"] = [
                "userId" => $user['user_id'],
                "userName" => $user['user_name'],
                "userEmail" => $user['user_email'],
                "isArtist" => (bool) $user['is_artist']
            ];
    
            echo json_encode(["message" => "Login successful", "user" => $user]);
    
        } catch (\Exception $e) {
            // Reverte a transação em caso de erro
            $connection->rollBack();
            http_response_code(500); // Código HTTP 500: Internal Server Error
            echo json_encode(["message" => "Erro ao registrar usuário: " . $e->getMessage()]);
        }
    }
    
    


    public function logout()
    {
        session_unset();
        // Verifica se o usuário está logado
        if (isset($_SESSION["isLogged"]) && $_SESSION["isLogged"] === true) {
            // Destruir as variáveis de sessão
            unset($_SESSION["isLogged"]);
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