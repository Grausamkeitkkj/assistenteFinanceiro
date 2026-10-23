<?php
namespace App\Classes\CategoriaGasto;

class CategoriaGasto {
    private $id_categoria_gasto;
    private $nome_categoria_gasto;

    public function __construct($id_categoria_gasto, $nome_categoria_gasto) {
        $this->id_categoria_gasto = $id_categoria_gasto;
        $this->nome_categoria_gasto = $nome_categoria_gasto;
    }

    public function getIdCategoriaGasto() {
        return $this->id_categoria_gasto;
    }

    public function getNomeCategoriaGasto() {
        return $this->nome_categoria_gasto;
    }
}