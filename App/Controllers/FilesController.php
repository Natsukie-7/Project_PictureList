<?php

namespace App\Controllers;

use App\Frameworks\Database\Connection;
use PDO;

class FilesController
{
    public static function index()
    {
        $data = ["title" => "Novo conteudo"];

        view("NewContent", $data);
    }

    public function renderFilePage($fileId)
    {
        try {
            $connection = Connection::getInstance();

            $stmt = $connection->prepare("SELECT
                    id,
                    title,
                    link
                FROM files
                WHERE id = :fileId
            ");

            $stmt->bindParam(':fileId', $fileId, PDO::PARAM_INT);
            $stmt->execute();

            $file = $stmt->fetch(PDO::FETCH_ASSOC);

            // Se não encontrar o arquivo, você pode redirecionar ou exibir uma mensagem de erro
            if (!$file) {
                echo "Arquivo não encontrado.";
                return;
            }

            // Prepare a consulta para pegar todos os arquivos, exceto o atual (para recomendações)
            $stmt = $connection->prepare("SELECT
                id,
                title,
                link
                FROM files
                WHERE id != :fileId
            ");
            $stmt->bindParam(':fileId', $fileId, PDO::PARAM_INT);
            $stmt->execute();

            // Recupera os arquivos recomendados (todos os arquivos exceto o selecionado)
            $recommended = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Passa os dados para a view
            $data = ["file" => $file, "recommended" => $recommended, "title" => $file["title"]];
            view("Content", $data);
        } catch (\PDOException $e) {
            // Caso ocorra um erro na execução da consulta, mostre a mensagem de erro
            echo "Erro ao recuperar o arquivo: " . $e->getMessage();
        }
    }




    public static function upload()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // Verifica se a imagem e o título foram enviados
        if (!(isset($data['imageData']) && isset($data['imageTitle']))) {
            echo json_encode(["message" => "Imagem e título são obrigatórios."]);
            return;
        }

        $imageData = $data['imageData'];
        $imageTitle = $data['imageTitle'];

        // Verifica se a imagem é válida (decodificando o base64)
        $image = base64_decode($imageData);
        if ($image === false) {
            echo json_encode(["message" => "Imagem inválida."]);
            exit;
        }

        try {
            // Conectar ao banco de dados
            $connection = Connection::getInstance();

            // Prepara a consulta para inserir a imagem no banco de dados
            $stmt = $connection->prepare("INSERT INTO files (link, title, fk_creator_user_id) VALUES (:link, :title, :fk_creator_user_id)");

            // Recupera o ID do usuário da sessão
            $fkCreatorUserId = $_SESSION["user"]["userId"];

            // Usa o parâmetro LOB para inserir dados binários
            $stmt->bindParam(':link', $image, PDO::PARAM_LOB);
            $stmt->bindParam(':title', $imageTitle);
            $stmt->bindParam(':fk_creator_user_id', $fkCreatorUserId);

            // Executa a consulta
            $stmt->execute();

            $fileId = $connection->lastInsertId();

            echo json_encode(["fileId" => (int) $fileId]);
        } catch (\PDOException $e) {
            echo json_encode(["message" => "Erro ao salvar a imagem: " . $e->getMessage()]);
        }
    }


    public static function requestAllFiles()
    {
        try {
            $connection = Connection::getInstance();

            // Recupera todos os arquivos (incluindo os dados binários da imagem)
            $stmt = $connection->prepare("SELECT id, title, link FROM files");
            $stmt->execute();
            $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Converte o campo 'link' de binário para base64 para que possa ser enviado para o front-end
            foreach ($files as &$file) {
                $file['link'] = base64_encode($file['link']); // Converte binário para base64
            }

            echo json_encode(["files" => $files]);
        } catch (\Exception $e) {
            echo json_encode(["message" => "Erro ao buscar arquivos: " . $e->getMessage()]);
        }
    }



}