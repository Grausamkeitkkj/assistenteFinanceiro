<?php
namespace App\Classes\Conexao;

use PDO;
use PDOException;

class Conexao {
    private PDO $pdo;

    public function __construct() {
        $host    = 'db'; // nome do serviço no docker-compose
        $db      = 'assistente_financeiro';
        $user    = 'root';
        $pass    = 'rootpassword';
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