<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

require_once __DIR__ . "/../Conexion/funciones/actualizar.php";
require_once __DIR__ . "/../Conexion/funciones/salvar_archivo.php";
require_once __DIR__ . "/../Conexion/funciones/obtener.php";


$accion = $_POST['accion'] ?? '';

switch ($accion) {

    case 'obtener':

        if (!isset($_POST["id"])) {
            echo json_encode(["error" => "ID no recibido"]);
            exit;
        }

        $id        = intval($_POST["id"]);
        $tabla     = "productos";
        $columnas  = ["id", "nombre", "codigo", "costo", "stock", "imagen", "descripcion"];
        $condicion = "id = '$id'";

        $producto  = obtener_campos($tabla, $columnas, $condicion);

        if ($producto && count($producto) > 0) {
            echo json_encode($producto[0]); 
        } else {
            echo json_encode(["error" => "Producto no encontrado"]);
        }
        exit;

    case 'actualizar':

        //  Subir archivo y obtener nombre nuevo
        $ruta = __DIR__ . "/../archivos/productos/";

        $nombreArchivo = guardar_archivo('archivo', $ruta );

        // Recibir el resto de datos del formulario
        $tabla      = "productos";
        $id         = intval($_POST["id"]);
        $nombre     = $_POST['nombre'] ?? '';
        $codigo     = $_POST['codigo'] ?? '';
        $costo      = $_POST['costo'] ?? '';
        $stock      = $_POST['stock'] ?? '';
        $descripcion= $_POST['descripcion'] ?? '';

        $columna   = ["codigo"];
        $condicion =  "codigo = '$codigo' AND id != '$id' ";

        $verificacion = obtener_campos($tabla, $columna , $condicion); 

        if (count($verificacion) > 0) {
            echo json_encode([
                "success" => false,
                "message" => "El codigo '$codigo' ya está registrado. Intenta con otro."
            ]);
            exit;
        }
        //  Insertar en la base de datos
        $condicion_col = "id"; 
        $condicion_val = $id;
        $columnas = ["nombre", "codigo", "costo", "stock", "descripcion"];
        $valores  = [$nombre, $codigo, $costo, $stock, $descripcion];

        if (!empty($nombreArchivo)) {
            $columnas[] = "imagen";
            $valores[]  = $nombreArchivo;
        }
        $resultado= actualizar_datos($tabla, $columnas, $valores, $condicion_col, $condicion_val);

        if ($resultado) {
            echo json_encode ([
                "success" => true,
                "message" => "Registro actualizado correctamente",
                'redirect' => 'productos_lista.php'
            ]);
        }else {
            echo json_encode ([
                "success" => false,
                "message" => "Error al actualizar al usuario en la base de datos"
            ]);
        }
        exit;
    default:
        echo json_encode(["error" => "Acción no válida"]);
        exit;
}
?>