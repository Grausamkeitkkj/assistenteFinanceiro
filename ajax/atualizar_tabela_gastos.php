<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\GastoPesquisa;
    use Util\PHP\FuncoesUteis;
    use App\Classes\Auth;
    $conexao = new Conexao();
    $pdo = $conexao->getPdo();
    $gastoPesquisa = new GastoPesquisa($pdo);
    Auth::requireLogin();
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo json_encode(['sucess' => false, 'message' => 'Método não permitido']);
        exit;
    }

    $idUsuario = $_SESSION['idUsuario'] ?? null;
    $vencimentoInicio = $_POST['data_vencimento_inicio_tabela'] ?? null;
    $vencimentoFim = $_POST['data_vencimento_fim_tabela'] ?? null;

    if(!$idUsuario || !$vencimentoInicio || !$vencimentoFim){
        echo json_encode(['success' => false, 'message' => 'Dados inválidos. Selecione as datas de início e fim.']);
        exit;
    }

    try {
        $retorno = $gastoPesquisa->getGastoPorData($idUsuario, $vencimentoInicio, $vencimentoFim);

        if(!empty($retorno)) {
            echo json_encode([
                'success' => true,
                'retorno' =>$retorno
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Nenhum dado encontrado para a data informada.'
            ]);
        }
    } catch (Exception $e) {
        http_response_code(500); // Define erro 500 para cair no callback 'error' do AJAX se preferir, ou retorna success: false
        echo json_encode([
            'success' => false,
            'message' => 'Erro interno: ' . $e->getMessage()
        ]);
    }
?>