<?php
namespace App\Classes;

use PDO;
use App\Classes\Conexao\Conexao;

class CategoriaGasto{
    private $id_categoria_gasto;
    private $nome_categoria_gasto;

    public function __construct( $id_categoria_gasto, $nome_categoria_gasto){
        $this->id_categoria_gasto = $id_categoria_gasto;
        $this->nome_categoria_gasto = $nome_categoria_gasto;
    }

    public static function getCategoriaGasto(PDO $pdo){
        $sql = "SELECT * 
                FROM categoria_gasto";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $categoriaGasto = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $categoriaGasto[] = new CategoriaGasto(
            $row['id_categoria_gasto'],
            $row['nome_categoria_gasto']);
        }
        return $categoriaGasto;
    }

     public function getIdCategoriaGasto() {
        return $this->id_categoria_gasto;
    }

    public function getNomeCategoriaGasto() {
        return $this->nome_categoria_gasto;
    }
}