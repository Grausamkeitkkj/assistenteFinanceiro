<?php
namespace App\Classes;

use PDO;
use App\Classes\Parcela;

class ParcelaPesquisa {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getParcelasPorIdGasto($idGasto){
        $sql = "SELECT a.id_parcela, a.gasto_id, a.numero_parcela, a.valor, a.vencimento, a.data_pagamento
                FROM parcela a
                JOIN gasto b ON a.gasto_id = b.id_gasto
                WHERE a.gasto_id = :id_gasto
                ORDER BY a.numero_parcela ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_gasto', $idGasto, PDO::PARAM_INT);
        $stmt->execute();

        $parcelas = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $parcelas[] = new Parcela(
                $row['id_parcela'],
                $row['gasto_id'],
                $row['numero_parcela'],
                $row['valor'],
                $row['vencimento'],
                $row['data_pagamento'],
                $row['usuario_parcela_id']
            );
        }
        return $parcelas;
    }

    public function insertParcela(Parcela $parcela) {
        $sql = "INSERT INTO parcela 
                (gasto_id, numero_parcela, valor, vencimento, data_pagamento, usuario_parcela_id)
                VALUES 
                (:gasto_id, :numero_parcela, :valor, :vencimento, :data_pagamento, :usuario_parcela_id)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':gasto_id', $parcela->getGastoId(), PDO::PARAM_INT);
        $stmt->bindValue(':numero_parcela', $parcela->getNumeroParcela(), PDO::PARAM_INT);
        $stmt->bindValue(':valor', $parcela->getValor());
        $stmt->bindValue(':vencimento', $parcela->getVencimento());
        $stmt->bindValue(':data_pagamento', $parcela->getDataPagamento());
        $stmt->bindValue(':usuario_parcela_id', $parcela->getUsuarioParcelaId());

        return $stmt->execute();
    }

    public function quitarParcela($idParcela) {
        $sql = "UPDATE parcela 
                SET data_pagamento = CURRENT_DATE 
                WHERE id_parcela = :id_parcela
                AND usuario_parcela_id = : usuario_parcela_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_parcela', $idParcela, PDO::PARAM_INT);
        $stmt->bindValue(':usuario_parcela_id', $_SESSION['idUsuario']);

        $stmt->execute();

        // Retorna a data atual no formato YYYY-MM-DD
        return date('Y-m-d');
    }

    public function editaDataPagamentoParcela($idParcela, $dataPagamento){
        if(!empty($dataPagamento)){
            $sql = "UPDATE parcela
                    SET data_pagamento = :data_pagamento
                    WHERE id_parcela = :id_parcela
                    AND usuario_parcela_id = : usuario_parcela_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':data_pagamento', $dataPagamento);
            $stmt->bindValue(':id_parcela', $idParcela, PDO::PARAM_INT);
            $stmt->bindValue(':usuario_parcela_id', $_SESSION['idUsuario']);
            return $stmt->execute();
        } else {
            $sql = "UPDATE parcela
                    SET data_pagamento = NULL
                    WHERE id_parcela = :id_parcela
                    AND usuario_parcela_id = : usuario_parcela_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id_parcela', $idParcela, PDO::PARAM_INT);
            $stmt->bindValue(':usuario_parcela_id', $_SESSION['idUsuario']);
            return $stmt->execute();
        }
    }

    
    public function getParcelaAgrupadoPorMesAnoPorData($idUsuario, $vencimentoInicio, $vencimentoFim){
        $sql = "SELECT a.*,
                    sum(a.valor) as total_valor,
                    DATE_FORMAT(a.vencimento, '%Y-%m') AS mes_ano, 
                    DATE_FORMAT(a.vencimento, '%M %Y') AS mes_ano_label 
                    FROM parcela as a
                    JOIN gasto b on a.gasto_id = b.id_gasto
                    WHERE b.id_usuario_gasto=:id_usuario_gasto
                    AND DATE_FORMAT(a.vencimento, '%Y-%m') BETWEEN :vencimentoInicio AND :vencimentoFim
                    GROUP BY mes_ano
                ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_usuario_gasto', $idUsuario, PDO::PARAM_INT);
        $stmt->bindValue(':vencimentoInicio', $vencimentoInicio, PDO::PARAM_STR);
        $stmt->bindValue(':vencimentoFim', $vencimentoFim, PDO::PARAM_STR);
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