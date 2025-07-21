<?php
namespace App\Classes;

use PDO;
use App\Classes\Parcela;

class ParcelaPesquisa {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public static function getParcelas(PDO $pdo){
        $sql = "SELECT a.*, b.*
                FROM parcela a
                JOIN gasto b ON a.gasto_id = b.id_gasto";
            
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $parcelas = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $parcelas[] = new Parcela(
                $row['id_parcela'],
                $row['gasto_id'],
                $row['numero_parcela'],
                $row['valor'],
                $row['vencimento'],
                $row['data_pagamento']
            );
        }
        return $parcelas;
    }

    public function insertParcela(Parcela $parcela) {
        $sql = "INSERT INTO parcela 
                (gasto_id, numero_parcela, valor, vencimento, data_pagamento)
                VALUES 
                (:gasto_id, :numero_parcela, :valor, :vencimento, :data_pagamento)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':gasto_id', $parcela->getGastoId(), PDO::PARAM_INT);
        $stmt->bindValue(':numero_parcela', $parcela->getNumeroParcela(), PDO::PARAM_INT);
        $stmt->bindValue(':valor', $parcela->getValor());
        $stmt->bindValue(':vencimento', $parcela->getVencimento());
        $stmt->bindValue(':data_pagamento', $parcela->getDataPagamento());

        return $stmt->execute();
    }

}