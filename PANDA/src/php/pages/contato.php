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
        <div class="card p-0">
            <div class="card-header">
                <h1 class="fw-bold">Contato</h1>
            </div>
            <div class="card-body">
                <h5 class="card-title">Erick Y. S. Kavano</h5>
                <h6 class="card-subtitle mb-2 text-muted">Desenvolvedor</h6>
                <p class="card-text">Aluno de Instituto Federal de Mato Grosso do Sul</p>
                <p class="card-text">Turma de Informática 126</p>
                <a href="mailto:erick.kavano@estudante.ifms.edu.br" class="card-link">erick.kavano@estudante.ifms.edu.br</a>
                <a href="tel:+5567991356155" class="card-link">(67)99135-6155</a>
            </div>
        </div>
    </div>
</body>