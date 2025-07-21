<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\Gasto;
    use App\Classes\GastoPesquisa;

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();

    $gastoArray = GastoPesquisa::getGasto($pdo);

    $GastoporMes = GastoPesquisa::getGastoAgrupadoPorMesAno($pdo);
    $labels = array_column($GastoporMes, 'mes_ano_label');// extrai da array os valores da coluna 'mes_ano_label'
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
            <div class="content">
                <label class="label-grafico" for="ano_inicio">De:</label>
                <select class="input-registration" id="mes_inicio_tabela" name="mes_inicio_tabela" required>
                    <option>Escolha o mês</option>
	                <option value="01">Janeiro</option>
	                <option value="02">Fevereiro</option>
	                <option value="03">Março</option>
	                <option value="04">Abril</option>
	                <option value="05">Maio</option>
	                <option value="06">Junho</option>
	                <option value="07">Julho</option>
	                <option value="08">Agosto</option>
	                <option value="09">Setembro</option>
	                <option value="10">Outubro</option>
	                <option value="11">Novembro</option>
	                <option value="12">Dezembro</option>
                </select>
                <select class="input-registration" id="ano_inicio_tabela" name="ano_inicio" required>
                    <option value="">Selecione um ano</option>
                </select>
                <label class="label-grafico" for="ano_fim">Até:</label>
                <select class="input-registration" id="mes_fim_tabela" name="mes_fim" required>
                    <option>Escolha o mês</option>
	                <option value="01">Janeiro</option>
	                <option value="02">Fevereiro</option>
	                <option value="03">Março</option>
	                <option value="04">Abril</option>
	                <option value="05">Maio</option>
	                <option value="06">Junho</option>
	                <option value="07">Julho</option>
	                <option value="08">Agosto</option>
	                <option value="09">Setembro</option>
	                <option value="10">Outubro</option>
	                <option value="11">Novembro</option>
	                <option value="12">Dezembro</option>
                </select>
                <select class="input-registration" id="ano_fim" name="ano_fim" required>
                    <option value="">Selecione um ano</option>
                </select>
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
                <label class="label-grafico" for="ano_inicio">De:</label>
                    <select class="input-registration" id="mes_inicio" name="mes_inicio" required>
                        <option>Escolha o mês</option>
	                    <option value="01">Janeiro</option>
	                    <option value="02">Fevereiro</option>
	                    <option value="03">Março</option>
	                    <option value="04">Abril</option>
	                    <option value="05">Maio</option>
	                    <option value="06">Junho</option>
	                    <option value="07">Julho</option>
	                    <option value="08">Agosto</option>
	                    <option value="09">Setembro</option>
	                    <option value="10">Outubro</option>
	                    <option value="11">Novembro</option>
	                    <option value="12">Dezembro</option>
                    </select>
                    <select class="input-registration" id="ano_inicio" name="ano_inicio" required>
                        <option value="">Selecione um ano</option>
                    </select>

                    <label class="label-grafico" for="ano_fim">Até:</label>
                    <select class="input-registration" id="mes_fim" name="mes_fim" required>
                        <option>Escolha o mês</option>
	                    <option value="01">Janeiro</option>
	                    <option value="02">Fevereiro</option>
	                    <option value="03">Março</option>
	                    <option value="04">Abril</option>
	                    <option value="05">Maio</option>
	                    <option value="06">Junho</option>
	                    <option value="07">Julho</option>
	                    <option value="08">Agosto</option>
	                    <option value="09">Setembro</option>
	                    <option value="10">Outubro</option>
	                    <option value="11">Novembro</option>
	                    <option value="12">Dezembro</option>
                    </select>
                    <select class="input-registration" id="ano_fim" name="ano_fim" required>
                        <option value="">Selecione um ano</option>
                    </select>
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
        <script>
            // Preenche os selects com anos de 2000 até o ano atual
            const selectAnoInicio = document.getElementById("ano_inicio");
            const selectAnoFim = document.getElementById("ano_fim");
            const anoAtual = new Date().getFullYear();

            for (let ano = anoAtual; ano >= 2000; ano--) {
                const optionInicio = document.createElement("option");
                const optionFim = document.createElement("option");
            
                optionInicio.value = optionFim.value = ano;
                optionInicio.textContent = optionFim.textContent = ano;
            
                selectAnoInicio.appendChild(optionInicio);
                selectAnoFim.appendChild(optionFim);
            }
        </script>
    </body>
</html>