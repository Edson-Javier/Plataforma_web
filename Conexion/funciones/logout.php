<?php
session_start();
session_unset();
session_destroy();
header("Location: /Plataforma_web/index.php");
exit;
?>
