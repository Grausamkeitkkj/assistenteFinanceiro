<?php
namespace App\Classes;

use PDO;
use PDOException;

class Conexao {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $db   = 'assistente_financeiro';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die('Conexão falhou: ' . $e->getMessage());
        }
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}
