<?php
namespace App\Classes;

use PDO;

class FormaPagamentoPesquisa {

    public static function getFormaPagamento(PDO $pdo) {
        $sql = "SELECT * FROM forma_pagamento";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}