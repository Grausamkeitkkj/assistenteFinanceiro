<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao;
    use App\Classes\Auth;
    Auth::requireLogin();

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();
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
                <h2 class="title-registration">Cadastro de investimento</h2>
                <form class="form-registration" method="POST">
                    <div class="grid">
                        <div class="form-group">
                            <label class="label-registration" for="ticket">Ticket do Investimento:</label>
                            <input class="input-registration" id="ticket" name="ticket" type="text" required>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="categoria_id">Categoria Investimento:</label>
                            <select class="input-registration" id="categoria_id" name="categoria_id" required>
                                <option value="">Selecione uma opção</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="valor">Valor por cota:</label>
                            <input class="input-registration" id="valor" name="valor" type="text" required>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="taxas">Taxas/Custos Operacionais:</label>
                            <input class="input-registration" id="taxas" name="taxas" type="text">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="total_cotas">Total de cotas:</label>
                            <input class="input-registration" id="total_cotas" name="total_cotas" type="number" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="data_investimento">Data do investimento:</label>
                            <input class="input-registration" id="data_investimento" name="data_investimento" type="date">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="data_vencimento">Data de vencimento(para CDB, LCI, LCA, Tesouro Direto):</label>
                            <input class="input-registration" id="data_vencimento" name="data_vencimento" type="date">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="rentabilidade">Rentabilidade:</label>
                            <input class="input-registration" id="rentabilidade" name="rentabilidade" type="text">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="observacoes">Observações:</label>
                            <textarea class="input-registration" id="observacoes" name="observacoes" rows="3"></textarea>
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
        <script src="Util/JS/ajaxRequest.js"></script>
        <script src="Util/JS/cadastroInvestimento.js"></script>
        <script src="Util/JS/autoLogout.js"></script>
    </body>
</html>
