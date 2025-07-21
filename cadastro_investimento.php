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
                <h2 class="title-registration">Cadastro de gasto/despesa/investimento</h2>
                <form class="form-registration">
                    <div class="grid">
                        <div class="form-group">
                            <label class="label-registration" for="produto1">Investimento:</label>
                            <input class="input-registration" id="produto1" type="text">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="valor">Aporte:</label>
                            <input class="input-registration" id="valor" type="text">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="valor">Valor Unit�rio:</label>
                            <input class="input-registration" id="valor" type="text">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="valor">Dividendos:</label>
                            <input class="input-registration" id="valor" type="text">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="valor2">N�mero de Cotas:</label>
                            <input class="input-registration" id="valor2" type="number">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="valor2">Data da Compra:</label>
                            <input class="input-registration" id="valor2" type="date">
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="produto2">Tipo de Investimento:</label>
                            <select class="input-registration" id="valor2">
                              <option value="">Selecione uma op��o</option>
                              <option value="opcao1">Op��o 1</option>
                              <option value="opcao2">Op��o 2</option>
                              <option value="opcao3">Op��o 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label-registration" for="valor2">Forma de Pagamento:</label>
                            <select class="input-registration" id="valor2">
                              <option value="">Selecione uma op��o</option>
                              <option value="opcao1">Op��o 1</option>
                              <option value="opcao2">Op��o 2</option>
                              <option value="opcao3">Op��o 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="button-container">
                        <button class="submit-button" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#valor').mask('#.##0,00', {reverse: true});
        });
    </script>
</html>
