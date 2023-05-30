<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Recado.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
$cSF = new SessionFunctions();
$cRecado = new Recado();
$cTurma = new Turma();


if ($_POST["formNum"] == 1) {
    if (
        isset($_POST["name_recado"]) && !empty($_POST["name_recado"]) &&
        isset($_POST["id_professor"]) && !empty($_POST["id_professor"]) &&
        isset($_POST["tipo_recado"]) && ($_POST["tipo_recado"] == 1 || $_POST["tipo_recado"] == 2) &&
        isset($_POST["mensagem"]) && !empty($_POST["mensagem"]) &&
        isset($_POST["dateMarcado"]) && !empty($_POST["dateMarcado"])
    ) {
        try {
            $id_professor = addslashes($_POST["id_professor"]);
            $dateMarcado = addslashes($_POST["dateMarcado"]);
            $titulo = addslashes($_POST["name_recado"]);
            $mensagem = addslashes($_POST["mensagem"]);
            $tipo = addslashes($_POST["tipo_recado"]);

            $idInsertedRecado = $cRecado->insertRecado($id_professor, $titulo, $mensagem, $dateMarcado, $tipo);
            if (gettype($idInsertedRecado) == "integer") {
                $cSF->setSessionData($idInsertedRecado, 'id_inserted_recado');
                echo $cSF->getSessionData('id_inserted_recado');
            } else {
                echo $idInsertedRecado;
            }
        } catch (Exception $e) {
            echo "Erro: $e";
        }
    } else {
        echo 'Erro: Algum dado está faltando';
    }
} else {
    if (
        isset($_POST["id_recado"]) && !empty($_POST["id_recado"]) &&
        isset($_POST["id_turma"]) && !empty($_POST["id_turma"])
    ) {
        $id_recado = addslashes($_POST["id_recado"]);
        $id_turmas = explode(',', addslashes($_POST["id_turma"]));
        $id_destinos = array();
        foreach ($id_turmas as $id_turma) {
            $turmaAlunos = $cTurma->getTurmaAlunos($id_turma);
            foreach ($turmaAlunos as $turmaAluno) {
                array_push($id_destinos, $turmaAluno["fk_id_user"]);
            }
        }
        
        foreach ($id_destinos as $id_destino) {
            try {
                $cRecado->insertRecadoDestino($id_recado, $id_destino);
                echo "true";
            } catch (Exception $e) {
                echo "Erro: $e";
            }
        }
    }
}
