<?php
session_start();
session_unset();
unset($_SESSION["ID"]);
unset($_SESSION["firstName"]);
unset($_SESSION["lastName"]);
unset($_SESSION["email"]); 
session_destroy();
$disable = true;
header('Location: about myself.html');
exit;
?>