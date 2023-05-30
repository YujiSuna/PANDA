<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
$cTurma = new Turma();

var_dump($_POST);

if (
    isset($_POST["id_aluno"])
    && !empty($_POST["id_aluno"])
    &&  isset($_POST["id_turma"])
    && !empty($_POST["id_turma"])
) {
    $id_alunos = explode(',', $_POST["id_aluno"]);
    $id_turma = $_POST["id_turma"];

    $bool['resultado'] = true;
    foreach ($id_alunos as $key => $id_aluno) {
        // $bool[$key] = $cTurma->insertTurmaAlunos($id_turma, $id_aluno);
        // $bool['resultado'] = $bool['resultado'] && $bool[$key];
        // var_dump($bool['resultado']);

        var_dump($cTurma->insertTurmaAlunos($id_turma, $id_aluno));
    }

    // if($bool['resultado']){
    //     echo 'true';
    // }else{
    //     echo 'false 1';
    // }
} else {
    echo 'false 2';
}
