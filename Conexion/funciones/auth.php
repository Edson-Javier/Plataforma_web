<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /Plataforma_web/index.php");
    exit;
}
?>
