<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/ART/class.Recado.php';
$cRecado = new Recado();

// var_dump($_POST);

if (
    isset($_POST["id_recado"])
    && !empty($_POST["id_recado"])
    &&  isset($_POST["id_receiver"])
    && !empty($_POST["id_receiver"])
) {
    $tipo = addslashes($_POST["tipo_recado"]);
    $id_recado = addslashes($_POST["id_recado"]);
    $id_receiver = addslashes($_POST["id_receiver"]);

    if (str_contains($id_receiver, ',')) {
        $receivers = explode(',', $id_receiver);
        foreach ($receivers as $receiver) {
            $bool = $cRecado->insertRecadoDestino($id_recado, $receiver, $tipo);
        }
    }else{
        $bool = $cRecado->insertRecadoDestino($id_recado, $id_receiver, $tipo);
    }

    if ($bool) {
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}
