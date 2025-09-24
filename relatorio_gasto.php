<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\Gasto;
    use App\Classes\GastoPesquisa;
    use App\Classes\ParcelaPesquisa;
    use App\Classes\Auth;
    use App\Classes\FuncoesUteis;

    Auth::requireLogin();

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();

    $gastoPesquisa = new GastoPesquisa($pdo);
    
    $gastoArray = $gastoPesquisa->getGasto($_SESSION['idUsuario']);

    $GastoporMes = $gastoPesquisa->getGastoAgrupadoPorMesAno($_SESSION['idUsuario']);
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
                <select class="input-registration ano" id="ano_inicio_tabela" name="ano_inicio" required>
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
                <select class="input-registration ano" id="ano_fim_tabela" name="ano_fim" required>
                    <option value="">Selecione um ano</option>
                </select>
                <button class="submit-button-table" type="submit">Salvar</button>
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
                                $dataPagamento = $gasto->getDataPagamento();
                                $produto = htmlspecialchars($gasto->getProduto());
                                $categoria = htmlspecialchars($gasto->getNomeCategoria());
                                $valorFormatado = FuncoesUteis::formatarValorParaExibir($gasto->getValor());
                                $formaPagamento = htmlspecialchars($gasto->getNomeFormaPagamento());
                                $parcelas = htmlspecialchars($gasto->getParcelasPagas() . '/' . $gasto->getTotalParcelas());
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
                                          <button class="toggle-btn" data-id-gasto="'.$idGasto.'">+</button>
                                        </td>
                                      </tr>';

                            }

                        ?>
                    </tbody>
                </table>
            </div>
            <div class="content">
                <label class="label-grafico">De:</label>
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
                    <select class="input-registration ano" id="ano_inicio_grafico" name="ano_inicio" required>
                        <option value="">Selecione um ano</option>
                    </select>

                    <label class="label-grafico">Até:</label>
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
                    <select class="input-registration ano" id="ano_fim_grafico" name="ano_fim" required>
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
            const selectsAno = document.querySelectorAll(".ano");
            const anoAtual = new Date().getFullYear();

            selectsAno.forEach(select => {
                for (let ano = anoAtual; ano >= 2000; ano--) {
                    const option = document.createElement("option");
                    option.value = ano;
                    option.textContent = ano;
                    select.appendChild(option);
                }
            });
        </script>
        <script>
            document.querySelectorAll('.toggle-btn').forEach(botao => {
                botao.addEventListener('click', () => {
                    const idGasto = botao.getAttribute('data-id-gasto');
                    window.location.href = 'parcela_gasto.php?idGasto=' + idGasto;
                });
            });
        </script>
    </body>
</html>