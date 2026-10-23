<?php
namespace App\Classes;

class FormaPagamento {
    private $id_forma_pagamento;
    private $nome_forma_pagamento;

    public function __construct($id_forma_pagamento = null, $nome_forma_pagamento = null) {
        $this->id_forma_pagamento = $id_forma_pagamento;
        $this->nome_forma_pagamento = $nome_forma_pagamento;
    }

    public function getIdFormaPagamento() {
        return $this->id_forma_pagamento;
    }

    public function getNomeFormaPagamento() {
        return $this->nome_forma_pagamento;
    }
}