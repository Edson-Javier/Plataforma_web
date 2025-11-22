<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

require_once __DIR__ . "/../Conexion/funciones/insertar.php";
require_once __DIR__ . "/../Conexion/funciones/salvar_archivo.php";
require_once __DIR__ . "/../Conexion/funciones/utilidades.php";
require_once __DIR__ . "/../Conexion/funciones/obtener.php";

$tabla = "productos";

//  Subir archivo y obtener nombre nuevo
$ruta = __DIR__ . "/../archivos/productos";

$nombreArchivo = guardar_archivo('archivo', $ruta );

// Recibir el resto de datos del formulario
$nombre     = $_POST['nombre'] ?? '';
$codigo     = $_POST['codigo'] ?? '';
$costo      = $_POST['costo'] ?? '';
$stock      = $_POST['stock'], ?? '';
$descripcion= $_POST['descripcion'] ?? 0;

$columna   = ["codigo"];
$condicion =  "codigo = '$codigo' AND eliminado = 0";

$verificacion = obtener_campos($tabla, $columna , $condicion); 

if (count($verificacion) > 0) {
    echo json_encode([
        "success" => false,
        "message" => "El codigo '$codigo' ya está registrado. Intenta con otro."
    ]);
    exit;
}
//  Insertar en la base de datos
$columnas = ["nombre", "codigo", "costo", "stock", "imagen", "descripcion"];
$valores  = [$nombre, $codigo, $costo, $stock, $nombreArchivo, $descripcion];

$resultado= insertar_datos($tabla, $columnas, $valores);

if ($resultado) {
    echo json_encode ([
        "success" => true,
        "message" => "Registro insertado correctamente",
        "nuevo_id" => id_nuevo($tabla),
        'redirect' => 'productos_lista.php'
    ]);
}else {
    echo json_encode ([
        "success" => false,
        "message" => "Error al insertar en la base de datos"
    ]);
}
exit;

?>