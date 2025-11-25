<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

require_once __DIR__ . "/../Conexion/funciones/obtener.php"; 

if (!isset($_POST["id"])) {
    echo json_encode(["error" => "ID no recibido"]);
    exit;
}

$id        = intval($_POST["id"]);
$tabla     = "productos";
$columnas  = ["id", "nombre", "codigo", "costo", "stock", "imagen", "descripcion", "status", "eliminar"];
$condicion = "id = '$id'";

$producto  = obtener_campos($tabla, $columnas, $condicion);

if ($producto && count($producto) > 0) {
    echo json_encode($producto[0]); 
} else {
    echo json_encode(["error" => "Producto no encontrado"]);
}

?>