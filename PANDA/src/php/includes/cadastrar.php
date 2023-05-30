<?php
$backToLogin = "<script>window.location='/PANDA/';</script>";
$backToRegistro = "<script>window.location='/PANDA/src/php/pages/cadastro.php';</script>";
if (
    $_POST['password']              ==        $_POST['checkpassword']  &&
    $_POST['email']                 ==        $_POST['checkemail']     &&
    isset($_POST['email'])          && !empty($_POST['email'])         &&
    isset($_POST['checkemail'])     && !empty($_POST['checkemail'])    &&
    isset($_POST['password'])       && !empty($_POST['password'])      &&
    isset($_POST['checkpassword'])  && !empty($_POST['checkpassword']) &&
    isset($_POST['name'])           && !empty($_POST['name'])          &&
    isset($_POST['surname'])        && !empty($_POST['surname'])       &&
    isset($_POST['birthday'])       && !empty($_POST['birthday'])      &&
    isset($_POST['phone'])          && !empty($_POST['phone'])         &&
    isset($_POST['gender'])         && !empty($_POST['gender'])
) {
    // $connection = new Connection();
    // $pdo = $connection->connectBank();
    require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
    $u = new Usuario();

    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);
    $name = addslashes($_POST['name']);
    $surname = addslashes($_POST['surname']);
    $birthday = addslashes($_POST['birthday']);
    $phone = addslashes($_POST['phone']);
    $gender = addslashes($_POST['gender']);

    if ($u->signin($name, $surname, $email, $password, $birthday, $gender, $phone)) {
        // $id_usuario = $pdo->lastInsertId();
        echo "<script>alert('Usuário cadastrado!');</script>";
        echo $backToLogin;
        // echo "<script>window.location = '/PANDA/src/html/registro/registro2.php?id=$id_usuario'</script>";
    } else {
        echo "<script>alert('Erro: email já cadastrado!');</script>";
        echo $backToLogin;
    }
} else {
    echo "<script>alert('Erro: confira os dados foram preenchidas corretamente!');</script>";
    echo $backToRegistro;
}
