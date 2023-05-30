<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PANDA | Painel</title>
    <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/painel.css">

    <?php include_once "../includes/onlineResorces.php" ?>
</head>

<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Painel.class.php';
$p = new Painel();

// $turmas = $p->listaTurma();
// $avaliacoes = $p->listaAvaliacao();
$encoding = mb_internal_encoding(); // ou UTF-8, ISO-8859-1...
?>

<body>
    <!--sidenav -->
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/sideNav/sideNav.php'; ?>
    <div class="container">
        <div class="card-group row gx-3">
            <div class="col-md-4 mb-3">
                <div class="card card-panda">
                    <h5 class="card-title text-center m-0">TURMAS</h5>
                    <div class="scroll">
                        <?php include '/xampp/htdocs/PANDA/src/php/includes/painel/turmas.php'; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card card-panda">
                    <h5 class="card-title text-center m-0">AVALIACOES</h5>
                    <div class="scroll">
                        <?php include '/xampp/htdocs/PANDA/src/php/includes/painel/avaliacoes.php'; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card card-panda">
                    <h5 class="card-title text-center m-0">RECADOS</h5>
                    <div class="scroll">
                        <?php include '/xampp/htdocs/PANDA/src/php/includes/painel/recados.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>