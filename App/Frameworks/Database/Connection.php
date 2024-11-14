<?php

namespace App\Frameworks\Database;

use PDO;

class Connection
{
    private static $connection = null;

    public static function getInstance()
    {
        if (empty(self::$connection)) {
            $databaseHost = $_ENV["DATABASE_HOST"];
            $databaseUser = $_ENV["DATABASE_USER"];
            $databasePassword = $_ENV["DATABASE_PASSWORD"];
            $databaseName = $_ENV["DATABASE_NAME"];

            self::$connection = new PDO(
                "mysql:host=$databaseHost;dbname=$databaseName",
                $databaseUser,
                $databasePassword,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]
            );
        }

        return self::$connection;
    }
}