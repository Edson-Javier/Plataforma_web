<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

require_once __DIR__ . "/Conexion/funciones/obtener.php"; 

if (!isset($_POST["id"])) {
    echo json_encode(["error" => "ID no recibido"]);
    exit;
}

$id = intval($_POST["id"]);
$tabla = "lista";
$columnas = ["id", "nombre", "apellido", "correo", "pass", "rol", "imagen"];
$condicion = "id = '$id'";

$empleado = obtener_campos($tabla, $columnas, $condicion);

if ($empleado) {
    echo json_encode($empleado);
} else {
    echo json_encode(["error" => "Empleado no encontrado"]);
}

?>