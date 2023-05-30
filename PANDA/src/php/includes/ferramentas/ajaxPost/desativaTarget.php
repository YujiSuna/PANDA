<?php
switch ($_POST['listedElement']) {
    case 'turmas':
        require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
        $PDOclass = new Turma();
        break;
    case 'alunos':
        require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
        $PDOclass = new Usuario();
        break;
    case 'recados':
        require_once '/xampp/htdocs/PANDA/src/php/class.php/Recado.class.php';
        $PDOclass = new Recado();
        break;
    case 'avaliacoes':
        require_once '/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php';
        $PDOclass = new Avaliacao();
        break;

    default:
        # code...
        break;
}

// var_dump($_POST);

if (isset($_POST["id_target"])) {
    $id_target = $_POST["id_target"];
    $newSituation = 0;

    echo $PDOclass->updateSituation($id_target, $newSituation);
}else{
    echo 0;
}