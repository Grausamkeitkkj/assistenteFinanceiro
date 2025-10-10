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
                                $dataPagamentoFormatado = !empty($dataPagamento) ? FuncoesUteis::formatarDataParaExibir($dataPagamento) : 'Sem data';
                        ?>
                        <tr data-id-parcela="<?= $parcelaId ?>">
                            <td><?= $numeroParcela ?></td>
                            <td><?= $valorFormatado ?></td>
                            <td><?= $vencimentoFormatado ?></td>
                            <td><?= $dataPagamentoFormatado ?></td>
                            <td>
                                <?php if (empty($dataPagamento)): ?>
                                    <button class="quitar-btn">✖</button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($dataPagamento)): ?>
                                    <button class="editar-btn">✎</button>
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
                $('.editar-btn').on('click', function(){
                    var linha = $(this).closest('tr');
                    var idParcela = linha.data('id-parcela');
                    $('#id_parcela').val(idParcela);
                    $('#modal').css('display', 'flex');
                });

                $('#modal').on('click', function(e) {
                    if ($(e.target).is('#modal')) {
                        $('#modal').css('display', 'none');
                        $('#id_parcela').val('');
                        $('#data_pagamento').val('')
                    }
                });

                $('#quitado').on('change', function(){
                    // O caractere ':' indica uma pseudo-classe, que seleciona elementos em um estado específico (ex: :checked, :hover, :focus)
                    if($(this).is(':checked')){
                        $('#data_pagamento').prop('disabled', false);
                    } else {
                        $('#data_pagamento').prop('disabled', true);
                        $('#data_pagamento').val('');
                    }
                });

            })
        </script>
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
                        <input class="input-registration" id="quitado" name="quitado" type="checkbox">
                    </div>
                </div>
                <div class="button-container">
                    <button class="submit-button" type="submit">Salvar</button>
                </div> 
            </form>
        </div>
    <script src="Util/JS/funcoesUteis.js"></script>
</html>