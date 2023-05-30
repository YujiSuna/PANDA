<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
require_once '/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php';

require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
$cSF = new SessionFunctions();
if (isset($_GET["id_avaliacao"])) {
    $cSF->setSessionData($_GET["id_avaliacao"], "id_avaliacao");
}

$cTurma = new Turma();
$cUsuario = new Usuario();
$cAvaliacao = new Avaliacao();

//obter informacoes da avaalicao
$id_avaliacao = $_SESSION["id_avaliacao"];
$avaliacao = $cAvaliacao->getAvaliacao($id_avaliacao);
$id_destino = $avaliacao["fk_id_destino"];
$avaliacao["professor"] = $cUsuario->getUser($avaliacao["fk_id_professor"]);
$avaliacao["professor"]["fullName"] = $avaliacao["professor"]["name"] . " " . $avaliacao["professor"]["surname"];

switch ($avaliacao["tipo"]) {
    case '1':
        $avaliacao["redirect"] = "/PANDA/src/php/includes/turma/turma.redirect.php";
        $avaliacao["tipoText"] = "Turma";
        $avaliado = $cTurma->getTurma($id_destino);
        $avaliado["name_avaliado"] = $avaliado["name_turma"];
        $avaliado["id_avaliado"] = ["id_turma", $avaliado["id_turma"]];
        $avaliacao["avaliado"] = $avaliado;
        break;

    case '2':
        $avaliacao["redirect"] = "/PANDA/src/php/includes/perfil/perfil.redirect.php";
        $avaliacao["tipoText"] = "Individual";
        $avaliado = $cUsuario->getUser($id_destino);
        $avaliado["name_avaliado"] = $avaliado["name"] . " " . $avaliado["surname"];
        $avaliado["id_avaliado"] = ["id_aluno", $avaliado["id_user"]];
        $avaliacao["avaliado"] = $avaliado;
        break;
    default:
        echo "<script>console.error('Erro ao identificar o tipo da avaliação')</script>";
        break;
}

echo "<script>const avaliacao = " . json_encode($avaliacao) . "</script>";
echo "<script>console.log(avaliacao)</script>";

//////////////////////////////////////////////////////////////////////

$includeLink = "/xampp/htdocs/PANDA/src/php/includes/avaliacao/table1.php";
if (isset($_GET["id_avaliacao"]) && !empty($_GET["id_avaliacao"])) {
    $includeLink = "/xampp/htdocs/PANDA/src/php/includes/avaliacao/table2.php";
    switch ($avaliacao["tipo"]) {
        case '1':
            $alunos = $cTurma->getTurmaAlunos($avaliado["id_turma"]);
            foreach ($alunos as $key => $aluno) {
                $id_user = $aluno['fk_id_user'];
                $aluno = $cUsuario->getUser($id_user);
                $aluno["id_avaliacao"] = $id_avaliacao;

                $search = "fk_id_avaliacao = $id_avaliacao AND fk_id_user = $id_user";
                $avaliacao_log = $cAvaliacao->getAvaliacoesLogBy($id_avaliacao);
                $aluno['avaliacao_log'] = $avaliacao_log;
                $alunos[$key] = $aluno;
            }
            break;

        case '2':

            break;

        default:
            echo "<script>console.error('Erro ao identificar o tipo da avaliação')</script>";
            break;
    }

    if ($cSF->getSessionData('nivel_user') == '2') {
        $id_user = $cSF->getSessionData('idUser');
        $aluno = $cUsuario->getUser($id_user);
        $aluno["id_avaliacao"] = $id_avaliacao;

        $search = "fk_id_avaliacao = $id_avaliacao AND fk_id_user = $id_user";
        $avaliacao_log = $cAvaliacao->getAvaliacoesLogBy($id_avaliacao);
        $aluno['avaliacao_log'] = $avaliacao_log;
        $alunos = [$aluno];
    }

    echo "<script>const alunos = " . json_encode($alunos) . "</script>";
    echo "<script>console.log(alunos)</script>";
}

