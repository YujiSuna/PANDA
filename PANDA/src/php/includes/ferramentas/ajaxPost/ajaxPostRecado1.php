<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/ART/class.Recado.php';
$cRecado = new Recado();

if (
    isset($_POST["name_recado"])
    && !empty($_POST["name_recado"])
    &&  isset($_POST["id_professor"])
    && !empty($_POST["id_professor"])
    &&  isset($_POST["tipo_recado"])
    && ($_POST["tipo_recado"] == 0 || $_POST["tipo_recado"] == 1)
    &&  isset($_POST["mensagem"])
    && !empty($_POST["mensagem"])
    &&  isset($_POST["dateMarcado"])
    && !empty($_POST["dateMarcado"])
) {
    $id_professor = addslashes($_POST["id_professor"]);
    $dateMarcado = addslashes($_POST["dateMarcado"]);
    $titulo = addslashes($_POST["name_recado"]);
    $mensagem = addslashes($_POST["mensagem"]);
    $tipo = addslashes($_POST["tipo_recado"]);

    $insertedRecado = $cRecado->insertRecado($id_professor, $titulo, $mensagem, $dateMarcado, $tipo);
    if (gettype($insertedRecado) != "boolean") {
        $insertedRecado['id'] = $_POST["id"];
        echo $_POST["url"]. '?'.http_build_query($insertedRecado);
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}
