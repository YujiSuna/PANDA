<?php
require_once "/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php";
$cAvaliacao = new Avaliacao();

// var_dump($_POST);

if (
    isset($_POST["name_avaliacao"])
    && !empty($_POST["name_avaliacao"])
    && isset($_POST["dataAvaliacao"])
    && !empty($_POST["dataAvaliacao"])
    &&  isset($_POST["id_user"])
    && !empty($_POST["id_user"])
    &&  isset($_POST["detalhe"])
    && !empty($_POST["detalhe"])
    &&  isset($_POST["tipo_avaliacao"])
    && ($_POST["tipo_avaliacao"] == 0 || $_POST["tipo_avaliacao"] == 1)
) {
    $id_user = addslashes($_POST["id_user"]);
    $name_avaliacao = addslashes($_POST["name_avaliacao"]);
    $data = addslashes($_POST["dataAvaliacao"]);
    $detalhe = addslashes($_POST["detalhe"]);
    $tipo = addslashes($_POST["tipo_avaliacao"]);

    $bool = $cAvaliacao->insertAvaliacao($id_user, $name_avaliacao, $data, $detalhe, $tipo);
    if ($bool) {
        echo 'true';
    } else {
        echo 'false1';
    }
} else {
    echo 'false2';
}

