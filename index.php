<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="icon/icon.png">
        <title>Login</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/custom_style_senha.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header class="header">
        </header>
        <main>
            <div class="content-centralize">
                <div class="content-login">
                    <h2 class="title-registration">Assistente Financeiro</h2>
                    <form class="form-registration" method="POST" action='login.php'>
                        <div class="form-group">
                            <label class="label-login">Email:</label>
                            <input class="input-login" name="emailnome" type="text" required placeholder="Digite seu e-mail ou nome de usuário">
                            <label class="label-login">Senha:</label>
                            <div class="container-senha">
                                <input class="input-login-senha" id="senha" name="senha" type="password" required placeholder="Digite sua senha">
                                <img id="imgToggleSenha" class="icone-senha" src="./icon/pass-on.svg">
                            </div>
                            <a href="#" class="forgot-password">Esqueceu a senha?</a>
                            <div class="button-container-login">
                                <button class="submit-button-login" type="submit">Login</button>
                            </div>
                            <p class="signup-link">
                                Não possui conta? <a href="cadastro_usuario.php">Cadastre-se aqui</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    </body>
    <script>
        $(".icone-senha").on("click", function(){
            const input = $("#senha");
            const img = $("#imgToggleSenha");
            const newImg = input.attr("type") === "password" ? "./icon/pass-on.svg" : "./icon/pass-off.svg";
            const type = input.attr("type") === "password" ? 'text' : "password";
            img.attr("src", newImg);
            input.attr("type", type);
        })
    </script>
</html>
