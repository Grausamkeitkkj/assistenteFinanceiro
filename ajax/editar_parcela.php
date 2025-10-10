<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\ParcelaPesquisa;
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo json_encode(['sucess' => false, 'message' => 'Método não permitido']);
        exit;
    }

    $idParcela = ($_POST['id_parcela'] ?? '') !== '' ? (int) $_POST['id_parcela'] : null;