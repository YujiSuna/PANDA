<?php
//get turma associadas
$auxTurmas = $cTurma->getAllTurmasAlunos("fk_id_turma");
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
$avaliacoes = $cAvaliacao->getAllAvaliacoes("id_avaliacao AS id, name_avaliacao AS name, tipo");
echo "<script>const avaliacoes = " . json_encode($avaliacoes) . "</script>";


//get recados associados
$recados = $cRecado->getAllRecados("id_recado AS id, name_recado AS name, tipo");
echo "<script>const recados = " . json_encode($recados) . "</script>";
