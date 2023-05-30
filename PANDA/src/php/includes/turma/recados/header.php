<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Recado.class.php';
$cTurma = new Turma();
$cRecado = new Recado();
$cUsuario = new Usuario();

include_once '/xampp/htdocs/PANDA/src/php/includes/turma/setData.php';

//obter informacoes da turma
$id_turma = $_SESSION["id_turma"];
$turma = $cTurma->getTurma($id_turma);
$recados = $cRecado->getAllRecadoDestinosBy($id_turma, "fk_id_destino");
foreach ($recados as $key => $recado) {
    $recados[$key] = $cRecado->getRecado($recado['fk_id_recado']);
}

//criando array JSON de recados
echo "<script>const recados = " . json_encode($recados) . "</script>";
?>

<script>
    console.log(recados);
</script>