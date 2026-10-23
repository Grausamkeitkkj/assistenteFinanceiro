<?php
namespace App\Classes\CategoriaGasto;

use PDO;

class CategoriaGastoPesquisa {

    public static function getCategoriaGasto(PDO $pdo) {
        $sql = "SELECT *
                FROM categoria_gasto";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}