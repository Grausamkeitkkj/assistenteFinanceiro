<?php
namespace App\Classes;

class Parcela {
    private $id_parcela;
    private $gasto_id;
    private $numero_parcela;
    private $valor;
    private $vencimento;
    private $data_pagamento;

    public function __construct($id_parcela, $gasto_id, $numero_parcela, $valor, $vencimento, $data_pagamento) {
        $this->id_parcela = $id_parcela;
        $this->gasto_id = $gasto_id;
        $this->numero_parcela = $numero_parcela;
        $this->valor = $valor;
        $this->vencimento = $vencimento;
        $this->data_pagamento = $data_pagamento;
    }

    public function getIdParcela() {
        return $this->id_parcela;
    }

    public function getGastoId() {
        return $this->gasto_id;
    }

    public function getNumeroParcela() {
        return $this->numero_parcela;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getVencimento() {
        return $this->vencimento;
    }

    public function getDataPagamento() {
        return $this->data_pagamento;
    }
}
