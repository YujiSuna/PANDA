<?php
session_start();
$_SESSION["id_turma"] = $_POST["id_turma"];
echo "/PANDA/src/php/pages/turma.php";