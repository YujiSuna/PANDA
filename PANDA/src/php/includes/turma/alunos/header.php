<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
$cTurma = new Turma();
$cUsuario = new Usuario();

//obter informacoes da turma
$id_turma = $_SESSION["id_turma"];
$turma = $cTurma->getTurma($id_turma);
$alunos = $cTurma->getTurmaAlunos($id_turma);

// adicionando nome do aluno
$auxAlunos = array();
foreach ($alunos as $aluno) {
    $id = $aluno["fk_id_user"];
    $user = $cUsuario->getUser($id);
    $aluno["name"] = $user["name"];
    $aluno["surname"] = $user["surname"];

    array_push($auxAlunos, $aluno);
}

$alunos = $auxAlunos;

//criando array JSON de recados
echo "<script>const alunos = " . json_encode($alunos) . "</script>";
?>

<script>
    console.log(alunos);
</script>