<?php
namespace App\Classes;

use App\Classes\Parcela;
use PDO;

class ParcelaFuncoes{
    public static function gerarParcelas($gastoId, $valorTotal, $totalParcelas, $dataVencimentoInicial) {
        $parcelas = [];

        $valorParcela = $valorTotal / $totalParcelas;   
        
        for ($i = 1; $i <= $totalParcelas; $i++) {
            $vencimento = date('Y-m-d', strtotime("+$i month", strtotime($dataVencimentoInicial))); 
            $parcelas[] = new Parcela(
                null,
                $gastoId,
                $i,
                $valorParcela,
                $vencimento,
                null
            );
        }   
        return $parcelas;
    }
}