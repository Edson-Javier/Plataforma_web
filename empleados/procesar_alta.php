<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

require_once __DIR__ . "/../Conexion/funciones/insertar.php";
require_once __DIR__ . "/../Conexion/funciones/salvar_archivo.php";
require_once __DIR__ . "/../Conexion/funciones/utilidades.php";
require_once __DIR__ . "/../Conexion/funciones/obtener.php";

$tabla = "lista";

//  Subir archivo y obtener nombre nuevo
$ruta = __DIR__ . "/../archivos/empleados";

$nombreArchivo = guardar_archivo('archivo', $ruta );

// Recibir el resto de datos del formulario
$nombre   = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$correo   = $_POST['correo'] ?? '';
$pass     = password_hash($_POST['pass'], PASSWORD_BCRYPT) ?? '';
$rol      = $_POST['rol'] ?? 0;

$columna   = ["correo"];
$condicion =  "correo = '$correo' ";

$verificacion = obtener_campos($tabla, $columna , $condicion); 

if (count($verificacion) > 0) {
    echo json_encode([
        "success" => false,
        "message" => "El correo '$correo' ya está registrado. Intenta con otro."
    ]);
    exit;
}
//  Insertar en la base de datos
$columnas = ["nombre", "apellido", "correo", "pass", "rol", "imagen"];
$valores  = [$nombre, $apellido, $correo, $pass, $rol, $nombreArchivo];

$resultado    = insertar_datos($tabla, $columnas, $valores);

if ($resultado) {
    echo json_encode ([
        "success" => true,
        "message" => "Registro insertado correctamente",
        "nuevo_id" => id_nuevo($tabla),
        'redirect' => 'empleados_lista.php'
    ]);
}else {
    echo json_encode ([
        "success" => false,
        "message" => "Error al insertar en la base de datos"
    ]);
}
exit;

?>