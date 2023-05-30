<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
$cTurma = new Turma();

if (isset($_POST["name_turma"]) 
&& !empty($_POST["name_turma"]) 
&&  isset($_POST["id_professor"]) 
&& !empty($_POST["id_professor"])) {
    $name_turma = $_POST["name_turma"];
    $id_professor = $_POST["id_professor"];
    $detalhe = null;

    if (isset($_POST["detalhe"]) && !empty($_POST["detalhe"])) {
        $detalhe = $_POST["detalhe"];
    }

    $bool = $cTurma->insertTurma($name_turma, $id_professor, $detalhe);
    if ($bool) {
        echo 'true';
    }else{
        echo 'false';
    }
}else{
    echo 'false';
}