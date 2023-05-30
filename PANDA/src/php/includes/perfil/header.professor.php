<?php
//get turma associadas
$turmas = $cTurma->getAllTurmaBy($id_target,"fk_id_professor", 'id_turma AS id, name_turma AS name');
$id_turmas = array();

echo "<script>const turmas = " . json_encode($turmas) . "</script>";

// get avaliacoes associadas
$avaliacoes = array();
$avaliacoesI = $cAvaliacao->getAllAvaliacoesBy($id_target, "fk_id_professor", 2, "id_avaliacao AS id, name_avaliacao AS name, tipo");
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
$recadosI = $cRecado->getAllRecadoBy($id_target, "fk_id_professor", 2, "id_recado AS id, name_recado AS name, tipo");
if ($recadosI) {
    foreach ($recadosI as $recado) {
        array_push($recados, $recado);
    }
}

foreach ($id_turmas as $id_turma) {
    $recadosTs = $cRecado->getAllRecadoBy($id_target, "fk_id_professor", 1, "id_recado AS id, name_recado AS name, tipo");
    if ($recadosTs) {
        foreach ($recadosTs as $recado) {
            array_push($recados, $recado);
        }
    }
}
echo "<script>const recados = " . json_encode($recados) . "</script>";
