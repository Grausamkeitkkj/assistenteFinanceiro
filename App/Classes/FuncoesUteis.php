<?php

namespace App\Classes;

class FuncoesUteis {
    public static function formatarDataParaExibir($data) {
        $dateTime = new \DateTime($data);
        return $dateTime->format('d/m/Y');
    }

    public static function formatarValorParaExibir($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

}