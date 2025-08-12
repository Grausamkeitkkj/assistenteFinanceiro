<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Classes\Conexao;

    $conexao = new Conexao();
    $pdo = $conexao->getPdo();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="icon/icon.png">
        <title>Login</title>
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header class="header">
        </header>
        <main>
            <div class="content-centralize">
                <div class="content-login">
                    <h2 class="title-registration">Login</h2>
                    <form class="form-registration" method="POST" action='Auth.php'>
                        <div class="form-group">
                            <label class="label-login">Email/Nome de usuário:</label>
                            <input class="input-login" id="produto" name="emailnome" type="text" required placeholder="Digite seu e-mail ou nome de usuário">
                            <label class="label-login">Senha:</label>
                            <input class="input-login" id="produto" name="senha" type="password" required placeholder="Digite sua senha">
                            <a href="#" class="forgot-password">Esqueceu a senha?</a>
                            <div class="button-container-login">
                                <button class="submit-button-login" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    </body>
</html>
