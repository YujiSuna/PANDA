<?php
//verificacao do usuario
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
$cSF = new SessionFunctions();
$id = $cSF->verifyUser();

require_once '/xampp/htdocs/PANDA/src/php/includes/recado/header.php';
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PANDA | Recado</title>
    <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/recado.css">

    <?php require_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php" ?>
</head>

<body>
    <!--sidenav -->
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/sideNav/sideNav.php' ?>
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/templates/modalTemplate.php' ?>
    <div class="container">
        <div class="card">
            <div class="card_body">
                <div class="row m-0 p-0 g-0 pt-3">
                    <div class="col-4 border-end ps-3">
                        <p id="name_recado" class="card-title text-center fs-1 fw-bold border-bottom">nome do recado</p>
                        <span class="fs-5">Tipo do recado:</span>
                        <p id="tipo_recado" class="fs-3 fw-bold"></p>
                        <span class="fs-5">Professor:</span>
                        <p id="name_professor" class="fs-3 fw-bold"></p>
                        <span class="fs-5">Receptor(es):</span>
                        <p id="name_receptor" class="fs-3 fw-bold"></p>
                    </div>
                    <div class="col-8 ps-5">
                        <span class="fs-5">Mensagem:</span>
                        <div class="scroll p-3">
                            <p id="detalhe_avaliacao" class="text-break"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="/PANDA/src/js/recado.js"></script>
<script>
    window.onload = setRecado(recado);
</script>