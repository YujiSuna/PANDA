<?php
//verificacao do usuario
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
$cSF = new SessionFunctions();
$id = $cSF->verifyUser();

require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
$cUsuario = new Usuario();
$nivel = $cUsuario->getUser($id, $search = 'id_user', $return = "nivel");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANDA | Remover</title>

    <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/ferramentas/cadastros.css">
    <?php include_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php"?>
</head>

<body>
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/sideNav/sideNav.php'; ?>

    <div class="container d-flex justify-content-center">
        <div id="card-cadastro" class="card">
            <nav>
                <div class="nav nav-tabs justify-content-around" id="nav-tab" role="tablist">
                    <button class="col-6 nav-link active" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-1" aria-selected="true"><strong>Turma</strong></button>
                    <button class="col-6 nav-link" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-2" aria-selected="false"><strong>Aluno</strong></button>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                    <?php include '/xampp/htdocs/PANDA/src/php/includes/ferramentas/cadastros/remocao-turma.php'; ?>
                </div>
                <div class="tab-pane" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
                    <?php include '/xampp/htdocs/PANDA/src/php/includes/ferramentas/cadastros/remocao-aluno.php'; ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(() => {
        let hash = document.location.hash;
        if (hash != null && hash != '') {
            tab = hash.slice(1);
            document.getElementById(tab).click();
        }
    });
</script>

</html>