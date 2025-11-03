<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . "/Conexion/funciones/obtener.php";

// Recibir el resto de datos del formulario
$correo   = $_POST['correo'] ?? '';
$pass     = $_POST['pass'] ?? '';
//Tabla de base de datos
$tabla = "lista";
//  Insertar en la base de datos
$columnas = ["correo", "pass"];
$condicion      =   "eliminar = 0 AND correo = '$correo' AND pass = '$pass' ";


$resultado = obtener_campos($tabla, $columnas , $condicion);


header('Content-Type: application/json');

if (count($resultado) > 0) {
        header("Location : empleados_lista.php ");
        echo json_encode(['status' => 'ok', 'mensaje' => 'Login correcto']);
        exit;
        
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'Correo no encontrado']);
}
exit;

?>