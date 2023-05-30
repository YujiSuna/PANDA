<?php
require_once "/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php";

$cAvaliacao = new Avaliacao();

if (isset($_POST)) {
    try {
        $id_user = $_POST["id_user"];
        $id_avaliacao = $_POST["id_avaliacao"];
        $aprovacao = $_POST["aprovacao"];
        $falta = $_POST["falta"];

        $search = "fk_id_avaliacao = $id_avaliacao AND fk_id_user = $id_user";
        $avaliacao_log = $cAvaliacao->getAvaliacoesLogBy($search);
        // echo json_encode($id_avaliacao_log); 

        if ($avaliacao_log != false) {
            // $search = "id_avaliacao_log = $id_avaliacao_log";
            $id_avaliacao_log = $avaliacao_log['id_avaliacao_log'];
            $avaliacao_log = $cAvaliacao->updateAvaliacaoLogBy($id_avaliacao_log, $aprovacao, $falta);
            if ($avaliacao_log) {
                $avaliacao_log = $cAvaliacao->getAvaliacoesLogBy($search);
            }
            echo json_encode($avaliacao_log); 
        }else{
            $inserted_id_avaliacao_log = $cAvaliacao->insertAvaliacaoLog($id_avaliacao, $id_user, $aprovacao, $falta);
            $avaliacao_log = $cAvaliacao->getAvaliacoesLogBy($search);
            echo json_encode($avaliacao_log); 
        }

        // $updated = $cAvaliacao->updateAvaliacaoLogBy($id_avaliacao_log, $aprovacao, $falta);

        // if ($updated) {
        //     $currentAvaliacao = $cAvaliacao->getAvaliacoesLogBy("id_avaliacao_log = $id_avaliacao_log");
        //     echo json_encode($currentAvaliacao);
        // } else {
        //     echo json_encode($updated);
        // }
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}

// echo json_encode($_POST);
