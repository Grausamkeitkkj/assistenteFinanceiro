<?php
namespace App\Classes;

use PDO;
use PDOException;

class Conexao {
    private $pdo;

    public function __construct() {
        $host = 'db'; // Alterado de 'localhost' para o nome do serviço no docker-compose
        $db   = 'assistente_financeiro'; // Nome do banco que colocou no DBeaver
        $user = 'root';
        $pass = 'rootpassword'; // Senha correta definida no Docker
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