<?php
session_start();
$_SESSION["id_avaliacao"] = $_POST["id_avaliacao"];
echo "/PANDA/src/php/pages/avaliacao.php";