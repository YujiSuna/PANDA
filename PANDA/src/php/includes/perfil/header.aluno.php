<?php
//get turma associadas
$auxTurmas = $cTurma->getTurmaAlunos($id_target, "fk_id_user", "fk_id_turma");
$id_turmas = array();
$turmas = array();
foreach ($auxTurmas as $auxTurma) {
    $id_turma = $auxTurma["fk_id_turma"];
    if (!in_array($id_turma, $id_turmas)) {
        array_push($id_turmas, $id_turma);
        $turma = $cTurma->getTurma($id_turma, 'id_turma', 'id_turma AS id, name_turma AS name');
        array_push($turmas, $turma);
    }
}
echo "<script>const turmas = " . json_encode($turmas) . "</script>";

// get avaliacoes associadas
$avaliacoes = array();
$avaliacoesI = $cAvaliacao->getAllAvaliacoesBy($id_target, "fk_id_destino", 2, "id_avaliacao AS id, name_avaliacao AS name, tipo");
foreach ($avaliacoesI as $avaliacao) {
    array_push($avaliacoes, $avaliacao);
}

foreach ($id_turmas as $id_turma) {
    $avaliacoesTs = $cAvaliacao->getAllAvaliacoesBy($id_turma, "fk_id_destino", 1, "id_avaliacao AS id, name_avaliacao AS name, tipo");
    foreach ($avaliacoesTs as $avaliacao) {
        array_push($avaliacoes, $avaliacao);
    }
}
echo "<script>const avaliacoes = " . json_encode($avaliacoes) . "</script>";


//get recados associados
$recados = array();
$recadosDestinosI = $cRecado->getAllRecadoDestinosBy($id_target, "fk_id_destino");

$recadosI = $cRecado->getAllRecados('id_recado AS id, name_recado AS name, tipo', 'ORDER BY situation DESC, data_marcada DESC', 2);
foreach ($recadosI as $recadoI) {
    $recadoDestinosI = $cRecado->getAllRecadoDestinosBy($recadoI['id'], "fk_id_recado");
    foreach ($recadoDestinosI as $recadoDestinoI) {
        if (in_array($recadoDestinoI['fk_id_destino'], $id_turmas)) {
            array_push($recados, $recadoI);
        }
    }
}

$recadosT = $cRecado->getAllRecados('id_recado AS id, name_recado AS name, tipo', 'ORDER BY situation DESC, data_marcada DESC', 1);
foreach ($recadosT as $recadoT) {
    $recadoDestinosT = $cRecado->getAllRecadoDestinosBy($recadoT['id'], "fk_id_recado");
    foreach ($recadoDestinosT as $recadoDestinoT ) {
        if (in_array($recadoDestinoT['fk_id_destino'], $id_turmas)) {
            array_push($recados, $recadoT);
        }
    }
}

echo "<script>const recados = " . json_encode($recados) . "</script>";
echo "<script>console.log(recados)</script>";
