<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
$cSF = new SessionFunctions();

if (!$cSF->verifyUser()) {
    header("location: /PANDA/src/php/pages/login.php");
} else {
    header("location: /PANDA/src/php/pages/painel.php");
}
