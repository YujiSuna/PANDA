<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANDA | Login</title>

    <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/login.css ">

    <?php include_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php"?>
</head>

<body>
    <div class="card card-panda w-75 position-absolute top-50 start-50 translate-middle">
        <form class="form" action="/PANDA/src/php/includes/logar.php" method="POST">
            <div class="row g-0">
                <div class="col-sm" id="login-left">
                    <img src="/PANDA/src/imagens/Logo_Panda.png" alt="">
                </div>
                <div class="col-sm" id="login-right">
                    <h1 id="bemVindo">BEM-VINDO</h1>
                    <p id="faca-login">
                        <label class="text-muted">Faça o login para continuar</label>
                    </p>

                    <div class="card-group">
                        <label class="text-muted">Email</label>
                        <input type="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="card-group">
                        <label class="text-muted">Senha</label>
                        <input type="password" name="password" placeholder="Digite sua senha" required>
                    </div>

                    <!-- <div id="recuperaSenha">
                        <a href="./src/html/senhaperdida/senhaPerdida.php" target="_self" rel="noopener noreferrer">
                            <span>esqueceu sua senha?</span>
                        </a>
                    </div> -->

                    <button type="submit" id="login-btn">LOGIN</button>

                    <div id="registro">
                        <h5 class="text-muted">Não possui uma conta?</h5>
                        <a href="/PANDA/src/php/pages/cadastro.php" target="_self" rel="noopener noreferrer">
                            <span>Registre-se</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

<script>
    window.onload = () => {
        let email = document.getElementsByName("email").item(0);
        email.focus();
    }
</script>
</html>