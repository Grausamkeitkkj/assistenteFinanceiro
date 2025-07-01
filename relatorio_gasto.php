<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\Gasto;
    use App\Classes\GastoPesquisa;

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();

    $gastoArray = GastoPesquisa::getGasto($pdo);

    $GastoporMes = GastoPesquisa::getGastoAgrupadoPorMesAno($pdo);
    $labels = array_column($GastoporMes, 'mes_ano_label');
    $valores = array_column($GastoporMes, 'total_valor');
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>Relatório</title>
      <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <header class="header">
            <?php include_once("menu.php") ?>
        </header>
        <main>
            <div class="content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Forma de Pagamento</th>
                            <th>Parcelas pagas/Total parcelas</th>
                            <th>Data Pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            <?php
                                foreach ($gastoArray as $gasto) {
                                    $vencimento = $gasto->getVencimento();
                                    $dataPagamento = $gasto->getDataPagamento();

                                    $produto = htmlspecialchars($gasto->getProduto());
                                    $categoria = htmlspecialchars($gasto->getNomeCategoria());
                                    $valorFormatado = 'R$ ' . number_format($gasto->getValor(), 2, ',', '.');
                                    $vencimentoFormatado = !empty($vencimento) ? date('d/m/Y', strtotime($vencimento)) : 'Sem data';
                                    $formaPagamento = htmlspecialchars($gasto->getNomeFormaPagamento());
                                    $parcelas = htmlspecialchars($gasto->getParcelasPagas() . '/' . $gasto->getTotalParcelas());
                                    $dataPagamentoFormatado = !empty($dataPagamento) ? date('d/m/Y', strtotime($dataPagamento)) : 'Sem data';
                                
                                    echo '<tr>
                                            <td>'.$produto.'</td>
                                            <td>'.$categoria.'</td>
                                            <td>'.$valorFormatado.'</td>
                                            <td>'.$vencimentoFormatado.'</td>
                                            <td>'.$formaPagamento.'</td>
                                            <td>'.$parcelas.'</td>
                                            <td>'.$dataPagamentoFormatado.'</td>
                                          </tr>';
                                }
                            ?>
                        </tbody>
                    </tbody>
                </table>
            </div>
            <div class="content">
                <canvas id="grafico1"></canvas>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            const labels = <?php echo json_encode($labels); ?>;
            const data = <?php echo json_encode($valores); ?>;
            const ctx = document.getElementById('grafico1').getContext('2d');
            const grafico = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total de Gastos por Mês',
                        data: data,
                        borderWidth: 1,
                        borderColor: '#6949ca',
                        backgroundColor: '#6949ca',
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'R$ ' + value.toFixed(2).replace('.', ',');
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </body>
</html>