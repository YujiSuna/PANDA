<?php
session_start();
$_SESSION["id_target"] = $_POST["id_target"];
echo "/PANDA/src/php/pages/perfil.php";
