<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php';
require_once "/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php";
require_once "/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php";
$cAvaliacao = new Avaliacao();
$cUsuario = new Usuario;
$cTurma = new Turma;

$avaliacoes = [];

switch ($nivel_user) {
    case '0':
        $avaliacoes = $cAvaliacao->getAllAvaliacoes();
        break;

    case '1':
        $avaliacoesT = $cAvaliacao->getAllAvaliacoesBy($id, 'fk_id_professor', '1');
        $avaliacoesI = $cAvaliacao->getAllAvaliacoesBy($id, 'fk_id_professor', '2');
        $avaliacoes = array_merge($avaliacoesT, $avaliacoesI);
        break;

    case '2':
        $avaliacoes = $cAvaliacao->getAllAvaliacoesBy($id, 'fk_id_destino', '2');
        $turmasAluno = $cTurma->getTurmaAlunos($id, 'fk_id_user');
        foreach ($turmasAluno as $turmaAluno) {
            $avaliacoes_turmas = $cAvaliacao->getAllAvaliacoesBy($turmaAluno['fk_id_turma'], 'fk_id_destino', '1');
            $avaliacoes = array_merge($avaliacoes, $avaliacoes_turmas);
        }
        sort($avaliacoes);
        break;

    default:
        $avaliacoes = [];
        break;
}

for ($key = 0; $key < count($avaliacoes); $key++) {
    $avaliacao = $avaliacoes[$key];
    $id_professor = $avaliacao['fk_id_professor'];
    $professor = $cUsuario->getUser($id_professor);
    $avaliacoes[$key]["name_professor"] = $professor['name'] . " " . $professor['surname'];
}

echo "<script>const avaliacoes = " . json_encode($avaliacoes) . "</script>";
?>

<ul class="list-group list-avaliacao"></ul>

<script src="/PANDA/src/js/painel.avaliacao.js"></script>