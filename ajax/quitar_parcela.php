<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Classes\Conexao\Conexao;
    use App\Classes\Parcela\ParcelaPesquisa;
    use App\Classes\Auth\Auth;
    use App\Classes\Auth\AuthCSFR;
    Auth::requireLogin();

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();
    $parcelaPesquisa = new ParcelaPesquisa($pdo);
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && AuthCSFR::autenticacaoCSFR()){

        $idParcela = ($_POST['id_parcela'] ?? '') !== '' ? (int)$_POST['id_parcela'] : null;

        try{
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
        }catch (PDOException $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Erro: ' . $e->getMessage()
            ]);
        }

    }