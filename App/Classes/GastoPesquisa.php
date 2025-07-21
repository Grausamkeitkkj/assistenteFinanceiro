<?php
namespace App\Classes;

use PDO;
use App\Classes\Gasto;

class GastoPesquisa {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
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

    public function insertGasto(Gasto $gasto) {
       $sql = "INSERT INTO gasto 
          (produto, categoria_id, valor, vencimento, forma_pagamento_id, parcelas_pagas, total_parcelas, data_pagamento)
          VALUES 
          (:produto, :categoria_id, :valor, :vencimento, :forma_pagamento_id, :parcelas_pagas, :total_parcelas, :data_pagamento)";
    
       $stmt = $this->pdo->prepare($sql);
       $stmt->bindValue(':produto', $gasto->getProduto());
       $stmt->bindValue(':categoria_id', $gasto->getCategoriaId(), PDO::PARAM_INT);
       $stmt->bindValue(':valor', $gasto->getValor());
       $stmt->bindValue(':vencimento', $gasto->getVencimento());
       $stmt->bindValue(':forma_pagamento_id', $gasto->getFormaPagamentoId(), PDO::PARAM_INT);
       $stmt->bindValue(':parcelas_pagas', $gasto->getParcelasPagas(), PDO::PARAM_INT);
       $stmt->bindValue(':total_parcelas', $gasto->getTotalParcelas(), PDO::PARAM_INT);
       $stmt->bindValue(':data_pagamento', $gasto->getDataPagamento());
        
        if ($stmt->execute()) {
            return $this->pdo->lastInsertId(); // <-- ISSO É ESSENCIAL
        } else {
            return false;
        }

    }
    

    public static function getGastoAgrupadoPorMesAno(PDO $pdo){
        $sql = "SELECT 
                    DATE_FORMAT(a.data_pagamento, '%Y-%m') AS mes_ano,
                    DATE_FORMAT(a.data_pagamento, '%M %Y') AS mes_ano_label,
                    SUM(a.valor) AS total_valor
                FROM gasto a
                GROUP BY mes_ano
                ORDER BY mes_ano DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $resultado = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = [
                'mes_ano' => $row['mes_ano'],
                'mes_ano_label' => $row['mes_ano_label'],
                'total_valor' => $row['total_valor']
            ];
        }
        return $resultado;
    }
}