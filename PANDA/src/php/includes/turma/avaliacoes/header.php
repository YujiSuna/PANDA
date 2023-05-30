<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Presenca.class.php';

$cTurma = new Turma();
$cUsuario = new Usuario();
$cPresenca = new Presenca();

//obter data atual ou data especificado
include_once '/xampp/htdocs/PANDA/src/php/includes/turma/setData.php';

//obter informacoes da turma
$id_turma = $_SESSION["id_turma"];
$turma = $cTurma->getTurma($id_turma);
$turma_alunos = $cTurma->getTurmaAlunos($id_turma);

//criando lista de alunos da turma
$alunos = array();
foreach ($turma_alunos as $turmaAluno) {
    $id_user = $turmaAluno["fk_id_user"]; //getUser info
    $userAluno = $cUsuario->getUser($id_user);

    //verify presenca
    $search = "fk_id_turma = $id_turma AND fk_id_user = $id_user AND date";
    $presenca = $cPresenca->getPresencaBy($date, $search, "presenca");
    if (!$presenca) {
        $cPresenca->insertPresenca($id_user, $id_turma, $date);
        $presenca = $cPresenca->getPresencaBy($date, $search, "presenca");
    }

    $userAluno["presenca"] = $presenca[0]["presenca"];
    $userAluno["id_turma"] = $id_turma;
    $userAluno["date"] = $date;

    array_push($alunos, $userAluno);
}

echo "<script>const alunos = " . json_encode($alunos) . "</script>";
?>