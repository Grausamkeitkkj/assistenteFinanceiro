<?php
namespace App\Classes;

use PDO;

class Gasto {
    private $id_gasto;
    private $produto;
    private $categoria_id;
    private $nome_categoria; // vem da outra tabela
    private $valor;
    private $vencimento;
    private $forma_pagamento_id;
    private $nome_forma_pagamento; // vem da outra tabela
    private $parcelas_pagas;
    private $total_parcelas;
    private $data_pagamento;

    public function __construct($id_gasto, $produto, $categoria_id, $nome_categoria, $valor, $vencimento, $forma_pagamento_id, $nome_forma_pagamento, $parcelas_pagas, $total_parcelas, $data_pagamento) {
        $this->id_gasto = $id_gasto;
        $this->produto = $produto;
        $this->categoria_id = $categoria_id;
        $this->nome_categoria = $nome_categoria;
        $this->valor = $valor;
        $this->vencimento = $vencimento;
        $this->forma_pagamento_id = $forma_pagamento_id;
        $this->nome_forma_pagamento = $nome_forma_pagamento;
        $this->parcelas_pagas = $parcelas_pagas;
        $this->total_parcelas = $total_parcelas;
        $this->data_pagamento = $data_pagamento;
    }

    public function getIdGasto() {
        return $this->id_gasto;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function getCategoriaId() {
        return $this->categoria_id;
    }

    public function getNomeCategoria() {
        return $this->nome_categoria;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getVencimento() {
        return $this->vencimento;
    }

    public function getFormaPagamentoId() {
        return $this->forma_pagamento_id;
    }

    public function getNomeFormaPagamento() {
        return $this->nome_forma_pagamento;
    }

    public function getParcelasPagas() {
        return $this->parcelas_pagas;
    }

    public function getTotalParcelas() {
        return $this->total_parcelas;
    }

    public function getDataPagamento() {
        return $this->data_pagamento;
    }
}
