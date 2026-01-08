<?php

namespace Util\PHP;

class FuncoesUteis {
    public static function formatarDataParaExibir($data) {
        return date('d/m/Y', strtotime($data));
    }

    public static function formatarValorParaExibir($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public static function traduzirMesAno($mesAnoLabel) {
        $mesesIngles = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        $mesesPortugues = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        return str_replace($mesesIngles, $mesesPortugues, $mesAnoLabel);
    }
}