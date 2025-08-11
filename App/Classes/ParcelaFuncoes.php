<?php
namespace App\Classes;

use App\Classes\Parcela;
use PDO;

class ParcelaFuncoes{
    public static function gerarParcelas($gastoId, $valorTotal, $totalParcelas, $data_pagamento) {
        $parcelas = [];
        $vencimento = $data_pagamento;

        $valorParcela = $valorTotal / $totalParcelas;   
        
        for ($i = 1; $i <= $totalParcelas; $i++) {
            $parcelas[] = new Parcela(
                null,
                $gastoId,
                $i,
                $valorParcela,
                $vencimento,
                null
            );
            $vencimento = date('Y-m-d', strtotime("+$i month", strtotime($data_pagamento))); 
        }   
        return $parcelas;
    }
}