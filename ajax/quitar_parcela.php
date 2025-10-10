<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\ParcelaPesquisa;
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo json_encode(['success' => false, 'message' => 'Método não permitido']);
        exit;
    }

    $idParcela = ($_POST['id_parcela'] ?? '') !== '' ? (int)$_POST['id_parcela'] : null;

    if(!$idParcela){
        echo json_encode(['success' => false, 'message' => 'ID da parcela não fornecido']);
        exit;
    }

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();
    $parcelaPesquisa = new ParcelaPesquisa($pdo);

    $dataPagamento = $parcelaPesquisa->quitarParcela($idParcela);

    if($dataPagamento) {
        echo json_encode([
            'success' => true,
            'message' => 'Parcela quitada com sucesso!',
            'id_parcela' => $idParcela,
            'data_pagamento' => $dataPagamento // Use o valor retornado do método
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao quitar parcela.'
        ]);
    }