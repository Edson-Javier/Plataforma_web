<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . "/Conexion/funciones/obtener.php";

header('Content-Type: application/json');

// Recibir datos del formulario
$correo   = $_POST['correo'] ?? '';
$pass     = password_hash($_POST['pass'], PASSWORD_BCRYPT) ?? '';
//Tabla de base de datos
$tabla = "lista";
//  Insertar en la base de datos
$columnas   = ["correo", "pass"];
$condicion  =   "eliminar = 0 AND correo = '$correo' ";


$resultado = obtener_campos($tabla, $columnas , $condicion);

if ($resultado && count($resultado) > 0) {
    $hashGuardado = $resultado[0]['pass'];

    if (password_verify($_POST['pass'], $hashGuardado)) {
        echo json_encode([
            'success' => true,
            'message' => 'Login correcto',
            'redirect' => 'empleados_lista.php'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Correo o contraseña incorrectos'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Correo o contraseña incorrectos'
    ]);
}
exit;


?>