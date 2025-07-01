<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\Gasto;

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();

    $gastoArray = Gasto::getGasto($pdo)
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
        </main>
    </body>
</html>