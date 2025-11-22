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
        $tabla     = "lista";
        $columnas  = ["id", "nombre", "apellido", "correo", "rol", "imagen", "eliminar"];
        $condicion = "id = '$id'";

        $empleado = obtener_campos($tabla, $columnas, $condicion);

        if ($empleado && count($empleado) > 0) {
            echo json_encode($empleado[0]); 
        } else {
            echo json_encode(["error" => "Empleado no encontrado"]);
        }
        exit;
    case 'eliminar':
        if (!isset($_POST["id"])) {
            echo json_encode(["error" => "ID no recibido"]);
            exit;
        }
        $tabla         = "lista";
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
                'redirect' => 'empleados_lista.php'
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