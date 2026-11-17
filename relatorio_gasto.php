<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao\Conexao;
    use App\Classes\Gasto\GastoPesquisa;
    use App\Classes\Auth\Auth;
    use Util\PHP\FuncoesUteis;

    Auth::requireLogin();

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();

    $gastoPesquisa = new GastoPesquisa($pdo);
    
    $gastoArray = $gastoPesquisa->getGasto($_SESSION['idUsuario']);

    $GastoporMes = $gastoPesquisa->getParcelaAgrupadoPorMesAno($_SESSION['idUsuario']);
    
    $labels = [];
    foreach ($GastoporMes as $item) {
        $labels[] = FuncoesUteis::traduzirMesAno($item['mes_ano_label']);
    }
    
    $valores = array_column($GastoporMes, 'total_valor');
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="icon/icon.png">
        <meta charset="UTF-8">
        <title>Relatório</title>
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <header class="header">
            <?php include_once("menu.php") ?>
        </header>
        <main>
            <div class="content margin-relatorio">
                <input class="input-registration" id="data_vencimento_inicio_tabela" name="data_vencimento_inicio_tabela" type="month">
                <input class="input-registration" id="data_vencimento_fim_tabela" name="data_vencimento_fim_tabela" type="month">
                <button id="table-button" class="submit-button-table" type="submit">Pesquisar</button>
                <table class="table tabela-gasto">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Forma de Pagamento</th>
                            <th>Parcelas pagas/Total parcelas</th>
                            <th>Data Pagamento</th>
                            <th>Parcelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            <?php
                                foreach ($gastoArray as $index => $gasto) {
                                    $dataPagamento = $gasto['data_pagamento'] ?? '';
                                    $dataPagamentoFormatado = !empty($dataPagamento) ? FuncoesUteis::formatarDataParaExibir($dataPagamento) : 'Sem data';
                        
                                    echo '<tr>
                                            <td>'.htmlspecialchars($gasto['produto'] ?? '').'</td>
                                            <td>'.htmlspecialchars($gasto['nome_categoria_gasto'] ?? '').'</td>
                                            <td>'.FuncoesUteis::formatarValorParaExibir($gasto['valor'] ?? 0).'</td>
                                            <td>'.htmlspecialchars($gasto['nome_forma_pagamento'] ?? '').'</td>
                                            <td>'.htmlspecialchars(($gasto['contagem_parcelas_pagas'] ?? 0) . '/' . ($gasto['total_parcelas'] ?? 0)).'</td>
                                            <td>'.$dataPagamentoFormatado.'</td>
                                            <td>
                                                <button class="parcela-btn pointer" data-id-gasto="'.$gasto['id_gasto'].'">+</button>
                                            </td>
                                          </tr>';
                                }
                            ?>
                        </tbody>
                    </tbody>
                </table>
            </div>
            <div class="content margin-relatorio">
            <input class="input-registration" id="data_vencimento_inicio_grafico" name="data_vencimento_inicio_grafico" type="month">
            <input class="input-registration" id="data_vencimento_fim_grafico" name="data_vencimento_fim_grafico" type="month">
            <button id="graphic-button" class="submit-button-table" type="submit">Pesquisar</button>
                <canvas id="grafico1"></canvas>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            const labels = <?php echo json_encode($labels); ?>;
            const data = <?php echo json_encode($valores); ?>;
        </script>
        <script src="Util/JS/relatorioGasto.js"></script>
        <script src="Util/JS/autoLogout.js"></script>
    </body>
</html>