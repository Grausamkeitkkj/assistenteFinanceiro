<?php
namespace App\Classes;

use PDO;
use App\Classes\Conexao;

class FormaPagamento {
    private $id_forma_pagamento;
    private $nome_forma_pagamento;

    public function __construct($id_forma_pagamento = null, $nome_forma_pagamento = null){
        $this->id_forma_pagamento = $id_forma_pagamento;
        $this->nome_forma_pagamento = $nome_forma_pagamento;
    }

    public static function getFormaPagamento(PDO $pdo){
        $sql = "SELECT * FROM forma_pagamento";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $formaPagamento = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $formaPagamento[] = new FormaPagamento(
                $row['id_forma_pagamento'],
                $row['nome_forma_pagamento']
            );
        }
        return $formaPagamento;
    }

    public function getIdFormaPagamento() {
        return $this->id_forma_pagamento;
    }

    public function getNomeFormaPagamento() {
        return $this->nome_forma_pagamento;
    }
}
