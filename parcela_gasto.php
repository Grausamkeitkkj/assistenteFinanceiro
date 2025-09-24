<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use App\Classes\Auth;
    use App\Classes\ParcelaPesquisa;
    use App\Classes\Conexao;
    use App\Classes\FuncoesUteis;

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
                            <th>Data de Pagamento</th>
                            <th>Quitar</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($parcelasArray as $index => $parcela) {
                                $parcelaId = $parcela->getIdParcela();
                                $numeroParcela = $parcela->getNumeroParcela();
                                $valor = $parcela->getValor();
                                $vencimento = $parcela->getVencimento();
                                $dataPagamento = $parcela->getDataPagamento();
                                $valorFormatado = FuncoesUteis::formatarValorParaExibir($valor);
                                $vencimentoFormatado = FuncoesUteis::formatarDataParaExibir($vencimento);
                                $dataPagamentoFormatado = !empty($dataPagamento) ? FuncoesUteis::formatarDataParaExibir($dataPagamento) : 'Sem data';
                                
                                echo '<tr>
                                        <td>'.$numeroParcela.'</td>
                                        <td>'.$valorFormatado.'</td>
                                        <td>'.$vencimentoFormatado.'</td>
                                        <td>'.$dataPagamentoFormatado.'</td>
                                        <td><a href="quitar_parcela.php?idParcela='.$parcelaId.'&idGasto='.$idGasto.'">Quitar</a></td>
                                        <td><a href="editar_parcela.php?idParcela='.$parcelaId.'&idGasto='.$idGasto.'">Editar</a></td>
                                        <td><a href="excluir_parcela.php?idParcela='.$parcelaId.'&idGasto='.$idGasto.'" onclick="return confirm(\'Tem certeza que deseja excluir esta parcela?\')">Excluir</a></td>
                                      </tr>';
                            }

                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
