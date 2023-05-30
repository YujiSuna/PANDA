<?php
session_start();
$_SESSION["id_recado"] = $_POST["id_recado"];
echo "/PANDA/src/php/pages/recado.php";