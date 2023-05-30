<?php
require_once "/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php";
require_once '/xampp/htdocs/PANDA/src/php/class.php/Recado.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
$cUsuario = new Usuario;
$cTurma = new Turma();
$cRecado = new Recado();

$recados = [];

switch ($nivel_user) {
    case '0':
        $recados = $cRecado->getAllRecados();
        break;

    case '1':
        $recados = $cRecado->getAllRecadoBy($id, 'fk_id_professor');
        break;

    case '2':
        $recado_destinos = $cRecado->getAllRecadoDestinosBy($id, 'fk_id_destino', 'fk_id_recado');

        if ($recado_destinos) {
            foreach ($recado_destinos as $key => $recados_log) {
                $recado = $cRecado->getRecado($recados_log['fk_id_recado']);
                if ($recado) {
                    $recados[$key] = $recado;
                }
            }
        }
        break;

    default:
        $recados = [];
        break;
}

for ($key = 0; $key < count($recados); $key++) {
    $recado = $recados[$key];
    $id_professor = $recado['fk_id_professor'];
    $professor = $cUsuario->getUser($id_professor);
    $recados[$key]["name_professor"] = $professor['name'] . " " . $professor['surname'];
}

echo "<script>const recados = " . json_encode($recados) . "</script>";
?>

<ul class="list-group list-recado"></ul>

<script src="/PANDA/src/js/painel.recado.js"></script>