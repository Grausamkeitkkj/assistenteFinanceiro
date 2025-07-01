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
                            <th>Investimento</th>
                            <th>Aporte</th>
                            <th>Valor Unitário</th>
                            <th>Dividendos</th>
                            <th>Número de Cotas</th>
                            <th>Data da Compra</th>
                            <th>Tipo de Investimento</th>
                            <th>Forma de Pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>FII XPTO11</td>
                            <td>1.000,00</td>
                            <td>100,00</td>
                            <th>0,10</th>
                            <td>10</td>
                            <td>2025-06-30</td>
                            <td>FII</td>
                            <td>TED</td>
                        </tr>
                        <tr>
                            <td>Tesouro IPCA</td>
                            <td>2.500,00</td>
                            <td>2.500,00</td>
                            <th>1,00</th>
                            <td>1</td>
                            <td>2029-08-15</td>
                            <td>Renda Fixa</td>
                            <td>Boleto</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>