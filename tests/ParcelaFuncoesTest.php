<?php

use PHPUnit\Framework\TestCase;
use App\Classes\ParcelaFuncoes;
use App\Classes\Parcela;

require_once __DIR__ . '/../vendor/autoload.php';

class ParcelaFuncoesTest extends TestCase
{
    public function testGerarParcelasCriaQuantidadeCorretaComValoresEDatas()
    {
        $gastoId = 42;
        $valorTotal = 300.00;
        $totalParcelas = 3;
        $dataPagamento = '2025-01-15';

        $parcelas = ParcelaFuncoes::gerarParcelas($gastoId, $valorTotal, $totalParcelas, $dataPagamento);

        // Quantidade
        $this->assertCount($totalParcelas, $parcelas);

        // Valor da parcela exato
        $valorEsperado = $valorTotal / $totalParcelas; // 100.00

        // Datas de vencimento esperadas conforme implementação atual
        $datasEsperadas = [
            '2025-01-15', // i=1 usa a data base
            '2025-02-15', // i=2 +1 mês
            '2025-03-15', // i=3 +2 meses
        ];

        foreach ($parcelas as $index => $parcela) {
            // Verifica se é uma instância de Parcela
            $this->assertInstanceOf(Parcela::class, $parcela);

            // Índice da parcela começa em 1
            $this->assertSame($index + 1, $parcela->getNumeroParcela());

            // Gasto ID
            $this->assertSame($gastoId, $parcela->getGastoId());

            // Valor da parcela
            $this->assertEquals($valorEsperado, $parcela->getValor());

            // Vencimento conforme regra atual (primeira parcela na data base)
            // assertSame verifica com ===, ao invés de só ==
            $this->assertSame($datasEsperadas[$index], $parcela->getVencimento());

            // Data de pagamento gerada como null
            $this->assertNull($parcela->getDataPagamento());
        }
    }
}
