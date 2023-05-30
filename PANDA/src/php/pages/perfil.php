<?php
//verificacao do usuario
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
$cSF = new SessionFunctions();
$id = $cSF->verifyUser();
require_once '/xampp/htdocs/PANDA/src/php/includes/perfil/header.php';
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PANDA | Perfil</title>
    <link rel="shortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/perfil.css">

    <?php require_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php" ?>
</head>

<body>
    <!--sidenav -->
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/sideNav/sideNav.php' ?>
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/templates/cardPandaTemplate.php' ?>

    <div class="container">
        <div class="card scroll">
            <div class="row p-0 g-0">
                <div id="perfilAluno" class="col-12 col-md-4 mb-3 mb-md-0 row p-0 g-0 row-cols-1 border-md-end border-bottom">
                    <div class="col m-auto d-flex justify-content-center">
                        <img src="/PANDA/src/imagens/avatar1.svg" alt="avatar.png" class="rounded-circle w-50" />
                    </div>
                    <div class="col info-target" id="fName">Nome:</div>
                    <div class="col info-target" id="lName">Sobrenome:</div>
                    <div class="col info-target" id="email">Email:</div>
                    <div class="col info-target" id="phone">Telefone:</div>
                    <div class="col info-target" id="genre">Genero:</div>
                    <div class="col info-target" id="birth">Aniversario:</div>
                </div>
                <div class="col-12 col-md-8 ps-3">
                    <div class="row p-0 g-0 h-100">
                        <h3 class="mt-3">Turmas:</h3>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-dark fw-bold" type="button" onclick="openModal(turmas, 'turma', setInfoKey)">Ver Turmas associadas</button>
                        </div>

                        <h3 class="mt-3">Avaliações:</h3>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-dark fw-bold" type="button" onclick="openModal(avaliacoes, 'avaliacao', setInfoKey)">Ver Avaliações associadas</button>
                        </div>

                        <h3 class="mt-3">Recados:</h3>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-dark fw-bold" type="button" onclick="openModal(recados, 'recado', setInfoKey)">Ver Recados associadas</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/PANDA/src/js/perfil.js"></script>
<script>
    console.log(window.onload = setInfoTarget(target));
</script>