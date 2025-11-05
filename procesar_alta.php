<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . "/Conexion/funciones/insertar.php";
require_once __DIR__ . "/Conexion/funciones/salvar_archivo.php";
require_once __DIR__ . "/Conexion/funciones/utilidades.php";

$tabla = "lista";

//  Subir archivo y obtener nombre nuevo
$ruta = __DIR__ . "/archivos/";

$nombreArchivo = guardar_archivo('archivo', $ruta );

// Recibir el resto de datos del formulario
$nombre   = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$correo   = $_POST['correo'] ?? '';
$pass     = password_hash($_POST['pass'], PASSWORD_BCRYPT) ?? '';
$rol      = $_POST['rol'] ?? 0;

//  Insertar en la base de datos
$columnas = ["nombre", "apellido", "correo", "pass", "rol", "imagen"];
$valores = [$nombre, $apellido, $correo, $pass, $rol, $nombreArchivo];

$resultado = insertar_datos($tabla, $columnas, $valores);

header('Content-Type: application/json');
require_once __DIR__ . '/Conexion/funciones/utilidades.php';

$response = ["success" => false, "message" => "Error desconocido"];

// Aquí haces la inserción, guardas archivo, etc.
if (isset($_POST['nombre'])) {
    // Lógica para guardar en base de datos...
    $response = [
        "success" => true,
        "message" => "Registro insertado correctamente",
        "nuevo_id" => id_nuevo($tabla),
        'redirect' => 'empleados_lista.php'
    ];
}

echo json_encode($response);
exit;

?>