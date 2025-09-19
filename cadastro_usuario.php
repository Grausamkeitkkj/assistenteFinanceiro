<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="icon/icon.png">
        <title>Cadastro</title>
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header class="header">
        </header>
        <main>
            <div class="content-centralize">
                <div class="content-register-user">
                    <h2 class="title-registration">Login</h2>
                    <form class="form-registration" method="POST" action="salvar_usuario.php">
                        <div class="form-group">
                            <label class="label-login">Email:</label>
                            <input class="input-login" name="email" type="text" required placeholder="Digite seu e-mail">
                            <label class="label-login">Nome:</label>
                            <input class="input-login" name="nome" type="text" required placeholder="Digite seu nome de usuário">
                            <label class="label-login">Senha:</label>
                            <input class="input-login" name="senha" type="password" required placeholder="Digite sua senha">
                            <label class="label-login">Repita a Senha:</label>
                            <input class="input-login" name="senhaConfirmacao" type="password" required placeholder="Digite novamente sua senha">
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
