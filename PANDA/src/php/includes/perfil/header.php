<?php
require_once "/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php";
require_once "/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php";
require_once "/xampp/htdocs/PANDA/src/php/class.php/Recado.class.php";
require_once "/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php";
$cAvaliacao = new Avaliacao();
$cUsuario = new Usuario();
$cRecado = new Recado();
$cTurma = new Turma();

//get target's info
$id_target = $cSF->getSessionData("id_target");
$return = "name, surname, email, phone, gender, birthday, nivel";
$target = $cUsuario->getUser($id_target, "id_user", $return);
echo "<script>const target = " . json_encode($target) . "</script>";

switch ($target["nivel"]) {
    case '0':
        require_once "/xampp/htdocs/PANDA/src/php/includes/perfil/header.admin.php";
        break;

    case '1':
        require_once "/xampp/htdocs/PANDA/src/php/includes/perfil/header.professor.php";
        break;

    default:
        require_once "/xampp/htdocs/PANDA/src/php/includes/perfil/header.aluno.php";
        break;
}
?>

<script>
    console.log(target);
    console.log(turmas);
    console.log(avaliacoes);
    console.log(recados);
</script>