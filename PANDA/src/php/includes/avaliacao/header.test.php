<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php';

$cTurma = new Turma();
$cUsuario = new Usuario();
$cAvaliacao = new Avaliacao();

//obter data atual ou data especificado
include_once '/xampp/htdocs/PANDA/src/php/includes/turma/setData.php';

//obter informacoes da avaliacao
$id_avaliacao = $_GET["id_avaliacao"];
$avaliacao = $cAvaliacao->getAvaliacao($id_avaliacao);
//obter logs da avaliacao
$avaliacao_logs = $cAvaliacao->getAllAvaliacoesLogsBy($id_avaliacao);

//criar lista de alunos que serao avaliados
$alunos = array();
switch ($avaliacao["tipo"]) {
    case '1':
        $id_aluno = $avaliacao["fk_id_destino"];
        //salvar dados do aluno
        break;
    
    default:
        # code...
        break;
}

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