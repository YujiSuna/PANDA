<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
  <title>PANDA | Cadastro</title>

  <?php include_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php" ?>
</head>

<style>
  body {
    background-color: steelblue;
  }

  label {
    font-weight: bolder;
  }
</style>

<body style="background-color: steelblue!important;">
  <div class="container">
    <div class="card card-panda mt-5 p-md-3">
      <div class="row" style="width: 95%; align-self: center;">
        <div class="col-md-12 order-md-1">
          <div class="text-center">
            <h3 class="mb-0 fw-bold" id="title">BEM-VINDO</h3>
            <h6 class="mb-3 text-secondary" id="subtitle">Crie sua conta para continuar</h6>
          </div>
          <label for="subtitle"></label>
          <form method="POST" action="/PANDA/src/php/includes/cadastrar.php" name="registro1" id="registro1" class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Insira seu email" maxlength="80" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="checkemail">Confirme seu email</label>
                <input type="email" class="form-control" name="checkemail" id="checkemail" placeholder="Insira novamente seu email" maxlength="80" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Insira sua senha" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="checkpassword">Confirme a senha</label>
                <input type="password" class="form-control" name="checkpassword" id="checkpassword" placeholder="Insira novamente sua senha" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Insira seu nome" maxlength="80" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="surname">Sobrenome</label>
                <input type="text" class="form-control" name="surname" id="surname" placeholder="Insira seu sobrenome" maxlength="80" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="birthday">Data de Nascimento</label>
                <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Insira sua data de nascimento" maxlength="14" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Insira seu telefone" maxlength="17" value="" required>
              </div>
              <div class="form-check col-md-4 mb-3">
                <input class="form-check-input" style="margin-left: -1em;" type="radio" required name="gender" value="masculino" id="masculino">
                <label class="form-check-label" style="margin-left: .5em;" id="labelMasculino" for="masculino">
                  Masculino
                </label>
              </div>
              <div class="form-check col-md-4 mb-3">
                <input class="form-check-input" style="margin-left: -1em;" type="radio" required name="gender" value="feminino" id="feminino">
                <label class="form-check-label" style="margin-left: .5em;" id="labelFeminino" for="feminino">
                  Feminino
                </label>
              </div>
              <div class="form-check col-md-4 mb-3">
                <input class="form-check-input" type="radio" required name="gender" value="indefinido" id="indefinido">
                <label class="form-check-label" id="labelIndefinido" for="indefinido">
                  Não quero responder
                </label>
              </div>
            </div>
            <div class="row justify-content-between align-items-center">
              <div class="col-md-4 order-md-1 order-sm-2 mt-2" id="voltar">
                <a class="btn btn-outline-secondary" onclick="backHistory()" style="text-decoration: none;">
                  <span>Voltar</span>
                </a>
              </div>
              <div class="col-md-8   order-md-2 order-sm-1" id="continuar">
                <button id="submit-button" class="btn btn-primary w-100" type="submit" form="registro1" value="Submit">Continuar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<script src="/PANDA/src/js/registro.js"></script>

</html>