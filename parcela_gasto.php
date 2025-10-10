<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use App\Classes\Auth;
    use App\Classes\ParcelaPesquisa;
    use App\Classes\Conexao;
    use Util\PHP\FuncoesUteis;

    Auth::requireLogin();

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();

    $idGasto = $_GET['idGasto'] ?? null;

    $parcelaPesquisa = new ParcelaPesquisa($pdo);
    $parcelasArray = $parcelaPesquisa->getParcelasPorIdGasto($idGasto);

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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número Parcela</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Data do Pagamento</th>
                            <th>Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($parcelasArray as $index => $parcela) {
                                //$index é o índice do array, começando em 0, e $parcela é o objeto Parcela correspondente
                                $parcelaId = $parcela->getIdParcela();
                                $numeroParcela = $parcela->getNumeroParcela();
                                $valor = $parcela->getValor();
                                $vencimento = $parcela->getVencimento();
                                $dataPagamento = $parcela->getDataPagamento();
                                $valorFormatado = FuncoesUteis::formatarValorParaExibir($valor);
                                $vencimentoFormatado = FuncoesUteis::formatarDataParaExibir($vencimento);
                                $dataPagamentoFormatado = !empty($dataPagamento) ? FuncoesUteis::formatarDataParaExibir($dataPagamento) : 'Sem data';
                                
                                echo '<tr data-id-parcela="'.$parcelaId.'">
                                        <td>'.$numeroParcela.'</td>
                                        <td>'.$valorFormatado.'</td>
                                        <td>'.$vencimentoFormatado.'</td>
                                        <td>'.$dataPagamentoFormatado.'</td>
                                        <td>
                                            <button class="quitar-btn">✖</button>
                                        </td>

                                      </tr>';
                            }

                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script>
            $(document).ready(function(){
                $('.quitar-btn').on('click', function(){
                    var linha = $(this).closest('tr');
                    var idParcela = linha.data('id-parcela');
                    var formData = { id_parcela: idParcela };

                    $.ajax({
                        url: './ajax/quitar_parcela.php',
                        type: 'POST',
                        data: formData
                    }).then(function(response) {
                        if(response.data_pagamento) {
                            linha.find('td').eq(3).text(formatarDataBR(response.data_pagamento));
                        }
                        alert('Parcela quitada com sucesso!');
                    }, function(jqXHR, textStatus, errorThrown) {
                        alert('Erro ao quitar parcela: ' + errorThrown);
                    });
                })
            })
        </script>
    </body>
    <script src="Util/JS/funcoesUteis.js"></script>
</html>