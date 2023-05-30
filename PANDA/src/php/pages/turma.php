<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
$cSF = new SessionFunctions();
//verificacao do usuario
$id = $cSF->verifyUser();

$turma_nav = filter_input(INPUT_GET, 'turma_nav');
$turma_nav = !$turma_nav ? "" : $turma_nav;
switch ($turma_nav) {
    case 'chamada':
        require_once '/xampp/htdocs/PANDA/src/php/includes/turma/chamada/header.php';
        $includeLink = "/xampp/htdocs/PANDA/src/php/includes/turma/chamada/table.first.php";
        if (isset($_GET['chamada_data']) && !empty($_GET['chamada_data'])) {
            $includeLink = "/xampp/htdocs/PANDA/src/php/includes/turma/chamada/table.second.php";
        }
        break;

    case 'recados':
        require_once '/xampp/htdocs/PANDA/src/php/includes/turma/recados/header.php';
        $includeLink = "/xampp/htdocs/PANDA/src/php/includes/turma/recados/table.php";
        break;

    case 'alunos':
        require_once '/xampp/htdocs/PANDA/src/php/includes/turma/alunos/header.php';
        $includeLink = "/xampp/htdocs/PANDA/src/php/includes/turma/alunos/table.php";
        break;

    case 'avaliacoes':
        require_once '/xampp/htdocs/PANDA/src/php/includes/turma/avaliacoes/header.php';
        $includeLink = "/xampp/htdocs/PANDA/src/php/includes/turma/avaliacoes/table.first.php";
        if (isset($_GET['avaliacoes_data']) && !empty($_GET['avaliacoes_data'])) {
            $includeLink = "/xampp/htdocs/PANDA/src/php/includes/turma/avaliacoes/table.second.php";
        }
        break;

    default:
        require_once '/xampp/htdocs/PANDA/src/php/includes/turma/sobre/header.php';
        $includeLink = "/xampp/htdocs/PANDA/src/php/includes/turma/sobre/table.php";
        break;
}
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PANDA | Turma</title>
    <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/turma.css">

    <?php require_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php" ?>
</head>

<body>
    <!--sidenav -->
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/sideNav/sideNav.php' ?>
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/templates/modalTemplate.php' ?>
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="col-md-3 p-0 pt-3 border-end d-md-block">
                    <p class="m-0 fs-1 fw-bolder text-center border-bottom"><?php echo $turma["name_turma"] ?></p>
                    <div class="d-flex flex-column align-items-center">
                        <div class="list-group list-group-flush w-100">
                            <a class="list-group-item list-group-item-action py-0" href="/PANDA/src/php/pages/turma.php?turma_nav=sobre">
                                <p class="col-12 m-0 fs-3 fw-bolder text-break text-center text-md-center">Sobre</p>
                            </a>
                            <a class="list-group-item list-group-item-action py-0" href="/PANDA/src/php/pages/turma.php?turma_nav=alunos">
                                <p class="col-12 m-0 fs-3 fw-bolder text-break text-center text-md-center">Alunos</p>
                            </a>
                            <a class="list-group-item list-group-item-action py-0" href="/PANDA/src/php/pages/turma.php?turma_nav=recados">
                                <p class="col-12 m-0 fs-3 fw-bolder text-break text-center text-md-center">Recados</p>
                            </a>
                            <a class="list-group-item list-group-item-action py-0" href="/PANDA/src/php/pages/turma.php?turma_nav=chamada">
                                <p class="col-12 m-0 fs-3 fw-bolder text-break text-center text-md-center">Chamada</p>
                            </a>
                            <a class="list-group-item list-group-item-action py-0" href="/PANDA/src/php/pages/turma.php?turma_nav=avaliacoes">
                                <p class="col-12 m-0 fs-3 fw-bolder text-break text-center text-md-center">Avaliações</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <?php require_once $includeLink ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>