<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANDA | Cadastros</title>

    <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/ferramentas/cadastros.css">

    <?php require_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php" ?>
</head>

<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
$cUsuario = new Usuario();
$cAvaliacao = new Avaliacao();
$cTurma = new Turma();

$allProfessors = $cUsuario->getAllUser(true, "professor");
$allAvaliacoes = $cAvaliacao->getAllAvaliacoes();
$allTurmas = $cTurma->getAllTurma('where situation = 1', 'id_turma, name_turma');
$allAlunos = $cUsuario->getAllUser(true, "aluno", 'id_user, name, surname');

echo
"<script>
    const allProfessors = " . json_encode($allProfessors) . ";
    const allAvaliacoes = " . json_encode($allAvaliacoes) . ";
    console.log(allAvaliacoes);
    const allTurmas = " . json_encode($allTurmas) . ";
    const allAlunos = " . json_encode($allAlunos) . ";
    const avaliacaoLink = " . json_encode($_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']) . "
</script>";

if (!(isset($_GET['bGFzdEFkZGVkUmVjYWRvSWQNCg']) && $_GET['bGFzdEFkZGVkUmVjYWRvSWQNCg'] > 0)) {
    $formNum = 1;
    if (isset($_GET['formNum']) && !empty($_GET['formNum'])) {
        $formNum = $_GET['formNum'];
    }
} else {
    $idAvaliacaoCriado = intval($_GET['bGFzdEFkZGVkUmVjYWRvSWQNCg']);
    $avaliacaoCriado = $cAvaliacao->getAvaliacao($idAvaliacaoCriado);
    $formNum = 2;
}
?>

<body>
    <!--sidenav -->
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/sideNav/sideNav.php' ?>

    <div class="container d-flex justify-content-center">
        <div id="card-cadastro" class="card">
            <nav>
                <div class="nav nav-tabs justify-content-around" id="nav-tab" role="tablist">
                    <button class="col-6 nav-link active" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-1" aria-selected="true"><strong>cadastro-avaliacao</strong></button>
                    <button class="col-6 nav-link" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-2" aria-selected="false"><strong>Aluno</strong></button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                    <div id="avaliacaoCardContent" class='cardContent mx-3 py-3'>
                        <?php include_once '/xampp/htdocs/PANDA/src/php/includes/ferramentas/cadastros/cadastro-avaliacaoForm1.php'; ?>
                    </div>
                </div>

                <div class="tab-pane" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
                    <div id="avaliacaoCardContent" class='cardContent mx-3 py-3'>
                        <?php include_once '/xampp/htdocs/PANDA/src/php/includes/ferramentas/cadastros/cadastro-avaliacaoForm2.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/PANDA/src/js/avaliacao.js"></script>
<script>
    setAJAXavaliacao(<?php echo $formNum ?>);
    var navLinks = document.querySelectorAll("button.nav-link");
    navLinks.forEach(navLink => {
        navLink.addEventListener("click", (evennt) => {
            if (navLink.classList.value.includes("active")) {
                let formNum = navLink.getAttribute("aria-controls").slice(-1);
                setAJAXavaliacao(formNum);
            }
        });
    });
</script>

<!-- virtual-select -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.16/dist/virtual-select.min.css" integrity="sha256-umM1c7RyV/yt71xjIgPErO3PYajUHRxxvWJn+YRWSWw=" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.16/dist/virtual-select.min.js" integrity="sha256-6PuvJQXKao5OMgfl/WZUzznOvrd0J3hZcaT0XpJRDO0=" crossorigin="anonymous"></script>

<script>
    <?php echo "var nav = 'nav-$formNum-tab';" ?>
    $(document).ready(() => {
        document.getElementById(nav).click();
    });
</script>

</html>