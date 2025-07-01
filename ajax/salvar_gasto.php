<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Classes\Conexao;
use App\Classes\Gasto;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {// '??' verifica se a variavel existe e nao e nula. Funciona da mesma forma do isset(). O valor a direita do ?? e o valor padrao
    $produto = ($_POST['produto'] ?? '') !== '' ? $_POST['produto'] : null;
    $categoria_id = ($_POST['categoria_id'] ?? '') !== '' ? (int)$_POST['categoria_id'] : null;
    $valor = ($_POST['valor'] ?? '') !== '' ? $_POST['valor'] : null;
    $vencimento = ($_POST['vencimento'] ?? '') !== '' ? $_POST['vencimento'] : null;
    $forma_pagamento_id = ($_POST['forma_pagamento_id'] ?? '') !== '' ? (int)$_POST['forma_pagamento_id'] : null;
    $parcelas_pagas = ($_POST['parcelas_pagas'] ?? '') !== '' ? (int)$_POST['parcelas_pagas'] : null;
    $total_parcelas = ($_POST['total_parcelas'] ?? '') !== '' ? (int)$_POST['total_parcelas'] : null;
    $data_pagamento = ($_POST['data_pagamento'] ?? '') !== '' ? $_POST['data_pagamento'] : null;
    
    if (!$produto || !$categoria_id || !$valor || !$forma_pagamento_id) {
        echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
        exit;
    }

    $valor = str_replace(['.', ','], ['', '.'], $valor);
    $conexao = new Conexao();
    $pdo = $conexao->getPdo();

    $gasto = new Gasto(null, $produto, $categoria_id, null, $valor, $vencimento, $forma_pagamento_id, null, $parcelas_pagas, $total_parcelas, $data_pagamento);

    try {
        if ($gasto->insertGasto($pdo)) {
            echo json_encode(['success' => true, 'message' => 'Gasto cadastrado com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao salvar gasto']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método inválido']);
}
