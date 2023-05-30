<?php
require_once "/xampp/htdocs/PANDA/src/php/class.php/Presenca.class.php";

// echo json_encode($_POST);

$cp = new Presenca();

if (isset($_POST)) {
    $id_user = $_POST["id_user"];
    $id_turma = $_POST["id_turma"];
    $date = $_POST["date"];
    $newPresenca = $_POST["presenca"];

    $search = "fk_id_turma = $id_turma AND fk_id_user = $id_user AND date";
    $id_presenca = $cp->getPresencaBy($date, $search, false, "id_presenca")["id_presenca"];
    $updated = $cp->updatePresencaById($id_presenca, $newPresenca);

    if ($updated) {
        //verify presenca
        $currentPresenca = $cp->getPresencaBy($id_presenca, "id_presenca", false);
        echo json_encode($currentPresenca);
    } else {
        echo json_encode($updated);
    }
}
