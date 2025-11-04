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
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($parcelasArray as $index => $parcela) {
                                // $index é o índice do array, começando em 0, e $parcela é o objeto Parcela correspondente
                                $parcelaId = $parcela->getIdParcela();
                                $numeroParcela = $parcela->getNumeroParcela();
                                $valor = $parcela->getValor();
                                $vencimento = $parcela->getVencimento();
                                $dataPagamento = $parcela->getDataPagamento();
                                $valorFormatado = FuncoesUteis::formatarValorParaExibir($valor);
                                $vencimentoFormatado = FuncoesUteis::formatarDataParaExibir($vencimento);
                                $dataPagamentoFormatado = !empty($dataPagamento) ? FuncoesUteis::formatarDataParaExibir($dataPagamento) : 'Não pago';
                        ?>
                        <tr data-pagamento ="<?= $dataPagamentoFormatado ?>" data-id-parcela="<?= $parcelaId ?>">
                            <td><?= $numeroParcela ?></td>
                            <td><?= $valorFormatado ?></td>
                            <td><?= $vencimentoFormatado ?></td>
                            <td><?= $dataPagamentoFormatado ?></td>
                            <td>
                                <?php if (empty($dataPagamento)): ?>
                                    <button class="quitar-btn pointer">✖</button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($dataPagamento)): ?>
                                    <button class="editar-btn pointer">✎</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                            }

                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </body>
    <div class="modal" id="modal">
        <div class="modal-content">
            <form class="form-registration" method="POST">
                <div class="grid">
                    <input type="hidden" id="id_parcela" name="id_parcela" value="">
                    <div class="form-group">
                        <label class="label-registration" for="data">Data:</label>
                        <input class="input-registration" id="data_pagamento" name="data_pagamento" type="date">
                    </div>
                    <div class="form-group">
                        <label class="label-registration" for="quitado">Quitado:</label>
                        <input class="input-registration" id="quitado" name="quitado" type="checkbox" checked>
                    </div>
                </div>
                <div class="button-container">
                    <button class="submit-button pointer editar-parcela" type="submit">Salvar</button>
                </div> 
            </form>
        </div>
    <script src="Util/JS/funcoesUteis.js"></script>
    <script src="Util/JS/parcelaGasto.js"></script>
    <script src="Util/JS/autoLogout.js"></script>
</html>