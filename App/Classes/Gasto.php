<?php
namespace App\Classes;

use PDO;

class Gasto {
    private $id_gasto;
    private $produto;
    private $categoria_id;
    private $nome_categoria; //vem da outra tabela
    private $valor;
    private $vencimento;
    private $forma_pagamento_id;
    private $nome_forma_pagamento;//vem da outra tabela
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

    public static function getGasto(PDO $pdo) { //passando um objeto do tipo PDO, dizendo a conexao
        $sql = "SELECT 
                    a.*, 
                    b.nome_categoria_gasto, 
                    c.nome_forma_pagamento
                FROM gasto a
                JOIN categoria_gasto b ON a.categoria_id = b.id_categoria_gasto
                JOIN forma_pagamento c ON a.forma_pagamento_id = c.id_forma_pagamento
                ORDER BY a.vencimento DESC;
                ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $gastos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {// PDO::FETCH_ASSOC é uma constante da classe PDO que representa o modo de retorno "array associativo"
            $gastos[] = new Gasto(
                $row['id_gasto'],
                $row['produto'],
                $row['categoria_id'],
                $row['nome_categoria_gasto'],
                $row['valor'],
                $row['vencimento'],
                $row['forma_pagamento_id'],
                $row['nome_forma_pagamento'],
                $row['parcelas_pagas'],
                $row['total_parcelas'],
                $row['data_pagamento']
            );
        }
        return $gastos;
    }

    public function getProduto() {
        return $this->produto;
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


    public function insertGasto(PDO $pdo){
        $sql = "INSERT INTO gasto 
           (produto, categoria_id, valor, vencimento, forma_pagamento_id, parcelas_pagas, total_parcelas, data_pagamento)
           VALUES 
           (:produto, :categoria_id, :valor, :vencimento, :forma_pagamento_id, :parcelas_pagas, :total_parcelas, :data_pagamento)";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':produto', $this->produto);
        $stmt->bindParam(':categoria_id', $this->categoria_id, PDO::PARAM_INT);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':vencimento', $this->vencimento);
        $stmt->bindParam(':forma_pagamento_id', $this->forma_pagamento_id, PDO::PARAM_INT);
        $stmt->bindParam(':parcelas_pagas', $this->parcelas_pagas, PDO::PARAM_INT);
        $stmt->bindParam(':total_parcelas', $this->total_parcelas, PDO::PARAM_INT);
        $stmt->bindParam(':data_pagamento', $this->data_pagamento);

        return $stmt->execute();
    }
}