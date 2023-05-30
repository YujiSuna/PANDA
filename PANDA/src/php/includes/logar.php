<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Usuario.class.php';
$u = new Usuario();

$backToLogin = "<script>window.location='/PANDA/';</script>";
$error = "<script>alert('E-mail ou Senha incorreta, tente novamente.');</script>";

if (isset($_POST['email']) && !empty($_POST['email']) && 
    isset($_POST['password']) && !empty($_POST['password'])) {

    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);
    $u->login($email, $password);
}

header("location: /PANDA/");