<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once __DIR__ . "/../Conexion/funciones/obtener.php"; 
require_once __DIR__ . "/../Conexion/funciones/actualizar.php";

$accion = $_POST['accion'] ?? '';

switch ($accion) {
    case 'obtener':
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
        exit;
    case 'eliminar':
        if (!isset($_POST["id"])) {
            echo json_encode(["error" => "ID no recibido"]);
            exit;
        }
        $tabla         = "productos";
        $id            = intval($_POST["id"]);
        $columnas      = ["eliminar"];
        $valores       = ["1"];
        $condicion_col = "id"; 
        $condicion_val = $id;
        $resultado     = actualizar_datos($tabla, $columnas, $valores, $condicion_col, $condicion_val);

        if ($resultado) {
            echo json_encode ([
                "success" => true,
                "message" => "Registro eliminado correctamente",
                'redirect' => 'productos_lista.php'
            ]);
        }else {
            echo json_encode([
                "success" => false,
                "error" => "No se pudo marcar el registro como eliminado."
            ]);
        }
        exit;
    
    default:
        echo json_encode(["error" => "Acción no válida"]);
        break;
}
?>