<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="icon/icon.png">
        <title>Login</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header class="header">
        </header>
        <main>
            <div class="content-centralize">
                <div class="content-login content-style">
                    <h2 class="title-registration">Assistente Financeiro</h2>
                    <form class="form-registration" method="POST" action="login.php">
                        <div class="form-group">
                            <label class="label-login" for="emailnome">Email</label>
                            <input class="input input-login" id="emailnome" name="emailnome" type="text" required placeholder="Digite seu e-mail ou nome de usuário">
                            <label class="label-login" for="senha">Senha</label>
                            <div class="container-senha">
                                <input class="input input-login" id="senha" name="senha" type="password" required placeholder="Digite sua senha">
                                <i id="imgToggleSenha" class="icone-senha fa-solid fa-eye-slash"></i>
                            </div>
                            <a href="#" class="forgot-password">Esqueceu a senha?</a>
                            <div class="button-container-login">
                                <button class="submit-button" type="submit">Login</button>
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
            $("#imgToggleSenha").on("click", function(){
                const input = $("#senha");
                const icon = $(this);
                
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                } else {
                    input.attr("type", "password");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                }
            });
        </script>
</html>
