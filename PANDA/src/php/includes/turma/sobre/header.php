<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Recado.class.php';
$cTurma = new Turma();
$cRecado = new Recado();
$cUsuario = new Usuario();

//obter informacoes da turma
$id_turma = $_SESSION["id_turma"];
$turma = $cTurma->getTurma($id_turma);

//criando array JSON de turma
echo "<script>const turma = " . json_encode($turma) . "</script>";

//obter nome completo do professor
$prof = $cUsuario->getUser($turma["fk_id_professor"]);
$prof['fullname'] = $prof['name'] . ' ' . $prof['surname'];
echo "<script>const prof = " . json_encode($prof) . "</script>";

//obter numero de alunos associados a esta turma
$numAlunos = $cTurma->getTurmaAlunoNumBy($id_turma);
echo "<script>const numAlunos = " . json_encode($numAlunos) . "</script>";

?>

<script>
    console.log(turma);
    console.log(prof);
    console.log(numAlunos);
</script>