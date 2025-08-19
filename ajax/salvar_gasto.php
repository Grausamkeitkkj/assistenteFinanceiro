<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Classes\Conexao;
use App\Classes\Gasto;
use App\Classes\GastoPesquisa;
use App\Classes\Parcela;
use App\Classes\ParcelaPesquisa;
use App\Classes\ParcelaFuncoes;
use App\Classes\Auth;
Auth::requireLogin();


$conexao = new Conexao();
$pdo = $conexao->getPdo();
$gastoPesquisa = new GastoPesquisa($pdo);
$parcelaPesquisa = new ParcelaPesquisa($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {// '??' verifica se a variavel existe e nao e nula. Funciona da mesma forma do isset(). O valor a direita do ?? e o valor padrao
    $produto = ($_POST['produto'] ?? '') !== '' ? $_POST['produto'] : null;
    $categoria_id = ($_POST['categoria_id'] ?? '') !== '' ? (int)$_POST['categoria_id'] : null;
    $valor = ($_POST['valor'] ?? '') !== '' ? $_POST['valor'] : null;
    $forma_pagamento_id = ($_POST['forma_pagamento_id'] ?? '') !== '' ? (int)$_POST['forma_pagamento_id'] : null;
    $parcelas_pagas = ($_POST['parcelas_pagas'] ?? '') !== '' ? (int)$_POST['parcelas_pagas'] : null;
    $total_parcelas = ($_POST['total_parcelas'] ?? '') !== '' ? (int)$_POST['total_parcelas'] : null;
    $data_pagamento = ($_POST['data_pagamento'] ?? '') !== '' ? $_POST['data_pagamento'] : null;
    $id_usuario_gasto = $_SESSION['idUsuario'];
    
    if (!$produto || !$categoria_id || !$valor || !$forma_pagamento_id) {
        echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
        exit;
    }

    $valor = str_replace(['.', ','], ['', '.'], $valor);

    $gasto = new Gasto(null, $produto, $categoria_id, null, $valor, $forma_pagamento_id, null, $parcelas_pagas, $total_parcelas, $data_pagamento, $id_usuario_gasto);

    try {
        $idGasto = $gastoPesquisa->insertGasto($gasto); // Agora captura o ID

        if ($idGasto) {
            echo json_encode([
                'success' => true,
                'message' => 'Gasto cadastrado com sucesso!',
                'id_gasto' => $idGasto // Retorna o ID via JSON também (se quiser usar no front)
            ]);

            $parcelas = ParcelaFuncoes::gerarParcelas($idGasto, $valor, $total_parcelas, $data_pagamento);
            foreach ($parcelas as $parcela) {
                $parcelaPesquisa->insertParcela($parcela);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Erro ao salvar gasto'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro: ' . $e->getMessage()
        ]);
    }
}
