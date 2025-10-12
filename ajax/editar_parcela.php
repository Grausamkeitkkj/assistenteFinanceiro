<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\ParcelaPesquisa;
    $conexao = new Conexao();
    $pdo = $conexao->getPdo();
    $parcelaPesquisa = new ParcelaPesquisa($pdo);
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo json_encode(['sucess' => false, 'message' => 'Método não permitido']);
        exit;
    }

    $idParcela = ($_POST['idParcela'] ?? '') !== '' ? (int) $_POST['idParcela'] : null;
    $dataPagamento = ($_POST['dataPagamento'] ?? '') !== '' ? $_POST['dataPagamento'] : null;

    if(!$idParcela){
        echo json_encode(['success' => false, 'message' => 'ID da parcela não fornecido']);
        exit;
    }

    $retorno = $parcelaPesquisa->editaDataPagamentoParcela($idParcela, $dataPagamento);

    if($retorno) {
        echo json_encode([
            'success' => true,
            'message' => 'Parcela quitada com sucesso!',
            'dataPagamento' => $dataPagamento
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao quitar parcela.'
        ]);
    }