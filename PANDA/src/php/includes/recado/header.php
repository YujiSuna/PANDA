<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Recado.class.php';

$cTurma = new Turma();
$cUsuario = new Usuario();
$cRecado = new Recado();

// obter informacoes da avaliacao
$id_recado = $_SESSION["id_recado"];
$recado = $cRecado->getRecado($id_recado);

$id_destino = $cRecado->getRecadoDestinoBy($id_recado)['fk_id_destino'];

$recado["professor"] = $cUsuario->getUser($recado["fk_id_professor"]);
$recado["professor"]["fullName"] = $recado["professor"]["name"] . " " . $recado["professor"]["surname"];

switch ($recado["tipo"]) {
    case '1':
        $recado["redirect"] = "/PANDA/src/php/includes/turma/turma.redirect.php";
        $recado["tipo"] = "Turma";
        $receptor = $cTurma->getTurma($id_destino, "id_turma", "id_turma, name_turma");
        $receptor["name_receptor"] = $receptor["name_turma"];
        $receptor["id_receptor"] = ["id_turma", $receptor["id_turma"]];
        $recado["receptor"] = $receptor;
        break;

    case '2':
        $recado["redirect"] = "/PANDA/src/php/includes/perfil/perfil.redirect.php";
        $recado["tipo"] = "Individual";
        $receptor = $cUsuario->getUser($id_destino);
        $receptor["name_receptor"] = $receptor["name"] . " " . $receptor["surname"];
        $receptor["id_receptor"] = ["id_aluno", $receptor["id_user"]];
        $recado["receptor"] = $receptor;
        break;
    default:
        echo "<script>console.error('Erro ao identificar o tipo do recado')</script>";
        break;
}

echo "<script>const recado = " . json_encode($recado) . "</script>";
?>

<script>
    console.log(recado);
</script>
