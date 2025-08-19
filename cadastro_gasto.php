<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\FormaPagamento;
    use App\Classes\CategoriaGasto;
    use App\Classes\Auth;
    Auth::requireLogin();

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();

    $formaPagamentoArray = FormaPagamento::getFormaPagamento($pdo);
    $categoriaPagamentoArray = CategoriaGasto::getCategoriaGasto($pdo);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="icon/icon.png">
        <title>Cadastro de gasto/despesa/investimento</title>
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header class="header">
            <?php include_once("menu.php") ?>
        </header>
        <main>
            <div class="content-cadastro-gasto">
                <h2 class="title-registration">Cadastro de gasto/despesa/investimento</h2>
                <form class="form-registration" method="POST">
                    <div class="grid">
                        <div class="form-group">
                            <label class="label-registration" for="produto">Produto:</label>
                            <input class="input-registration" id="produto" name="produto" type="text" required>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="categoria_id">Categoria:</label>
                            <select class="input-registration" id="categoria_id" name="categoria_id" required>
                                <option value="">Selecione uma opção</option>
                                <?php
                                    foreach($categoriaPagamentoArray as $categoriaPagamento){
                                        echo "<option value='".$categoriaPagamento->getIdCategoriaGasto()."'>".htmlspecialchars($categoriaPagamento->getNomeCategoriaGasto())."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="valor">Valor:</label>
                            <input class="input-registration" id="valor" name="valor" type="text" required>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="forma_pagamento_id">Método de Pagamento:</label>
                            <select class="input-registration" id="forma_pagamento_id" name="forma_pagamento_id" required>
                                <option value="">Selecione uma opção</option>
                                <?php
                                    foreach ($formaPagamentoArray as $formaPagamento) {
                                        echo "<option value='".$formaPagamento->getIdFormaPagamento()."'>".htmlspecialchars($formaPagamento->getNomeFormaPagamento())."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="parcelas_pagas">Parcelas Pagas:</label>
                            <input class="input-registration" id="parcelas_pagas" name="parcelas_pagas" type="number" min="0" value="1">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="total_parcelas">Total Parcelas:</label>
                            <input class="input-registration" id="total_parcelas" name="total_parcelas" type="number" min="1" value="1">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="data_pagamento">Data Pagamento:</label>
                            <input class="input-registration" id="data_pagamento" name="data_pagamento" type="date">
                        </div>
                    </div>
                    <div class="button-container">
                        <button class="submit-button" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#valor').mask('#.##0,00', { reverse: true });

                $('.form-registration').submit(function(e) { // 'e' é o objeto do evento de submit do formulário
                    e.preventDefault();
                
                    var formData = $(this).serialize();
                
                    $.ajax({
                        url: './ajax/salvar_gasto.php',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) { 
                            if (response.success) {
                                alert(response.message);
                                $('.form-registration')[0].reset();
                            } else {
                                alert('Erro: ' + response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Erro na requisição AJAX.\n' +
                                  'Status: ' + textStatus + '\n' +
                                  'Erro: ' + errorThrown + '\n' +
                                  'Resposta: ' + jqXHR.responseText);
                        }

                    });
                });
            });
        </script>
    </body>
</html>
