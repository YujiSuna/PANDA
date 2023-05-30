<?php
//verificacao do usuario
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
$cSF = new SessionFunctions();
$id = $cSF->verifyUser();
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PANDA | Avaliacao</title>
    <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/avaliacao.css">

    <?php require_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php" ?>
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/avaliacao/header.php'?>
</head>

<body>
    <!--sidenav -->
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/sideNav/sideNav.php' ?>
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/templates/modalTemplate.php' ?>
    <div class="container">
        <div class="card">
            <div class="card_body">
                <?php require_once $includeLink ?>
            </div>
        </div>
    </div>
</body>

</html>

<script src="/PANDA/src/js/avaliacao.js"></script>
<script>
    window.onload = setAvaliacao(avaliacao);
</script>