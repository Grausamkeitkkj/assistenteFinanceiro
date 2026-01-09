<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\Gasto;
    use App\Classes\GastoPesquisa;
    use App\Classes\ParcelaPesquisa;
    use App\Classes\Auth;
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
                <input class="input-registration" id="date_table" name="date_table" type="date">
                <button id="table-button" class="submit-button-table" type="submit">Pesquisar</button>
                <table class="table">
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
                        <?php
                            foreach ($gastoArray as $index => $gasto) {
                                $idGasto = $gasto->getIdGasto();
                                $contagemParcelasPagas = $gasto->getContagemParcelasPagas();
                                $dataPagamento = $gasto->getDataPagamento();
                                $produto = htmlspecialchars($gasto->getProduto());
                                $categoria = htmlspecialchars($gasto->getNomeCategoria());
                                $valorFormatado = FuncoesUteis::formatarValorParaExibir($gasto->getValor());
                                $formaPagamento = htmlspecialchars($gasto->getNomeFormaPagamento());
                                $parcelas = htmlspecialchars($contagemParcelasPagas.'/' . $gasto->getTotalParcelas());
                                $dataPagamentoFormatado = !empty($dataPagamento) ? FuncoesUteis::formatarDataParaExibir($dataPagamento) : 'Sem data';

                                // Linha principal
                                echo '<tr>
                                        <td>'.$produto.'</td>
                                        <td>'.$categoria.'</td>
                                        <td>'.$valorFormatado.'</td>
                                        <td>'.$formaPagamento.'</td>
                                        <td>'.$parcelas.'</td>
                                        <td>'.$dataPagamentoFormatado.'</td>
                                        <td>
                                            <button class="parcela-btn pointer" data-id-gasto="'.$idGasto.'">+</button>
                                        </td>
                                      </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="content margin-relatorio">
            <input class="input-registration" id="data_vencimento" name="data_vencimento" type="date">
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