<?php
require_once "/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php";
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
$cUsuario = new Usuario;
$cTurma = new Turma();

$avaliacoes = [];

switch ($nivel_user) {
    case '0':
        $turmas = $cTurma->getAllTurma();
        break;

    case '1':
        $turmas = $cTurma->getAllTurmaBy($id, 'fk_id_professor');
        break;

    case '2':
        $turmas = $cTurma->getTurmaAlunos($id, 'fk_id_user', 'fk_id_turma');
        foreach ($turmas as $key => $turma) {
            $turma = $cTurma->getTurma($turma['fk_id_turma']);
            $turmas[$key] = $turma;
        }
        break;

    default:
        $turmas = [];
        break;
}

for ($key = 0; $key < count($turmas); $key++) {
    $turma = $turmas[$key];
    $id_professor = $turma['fk_id_professor'];
    $professor = $cUsuario->getUser($id_professor);
    $turmas[$key]["name_professor"] = $professor['name'] . " " . $professor['surname'];
}

echo "<script>const turmas = " . json_encode($turmas) . "</script>";
?>

<ul class="list-group list-turma"></ul>

<script src="/PANDA/src/js/painel.turma.js"></script>