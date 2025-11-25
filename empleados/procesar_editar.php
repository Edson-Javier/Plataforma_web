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

        $id = intval($_POST["id"]);
        $tabla = "lista";
        $columnas = ["id", "nombre", "apellido", "correo", "rol", "imagen"];
        $condicion = "id = '$id'";

        $empleado = obtener_campos($tabla, $columnas, $condicion);

        if ($empleado && count($empleado) > 0) {
            echo json_encode($empleado[0]); 
        } else {
            echo json_encode(["error" => "Empleado no encontrado"]);
        }
        exit;

    case 'actualizar':

        //  Subir archivo y obtener nombre nuevo
        $ruta = __DIR__ . "/../archivos/empleados/";

        $nombreArchivo = guardar_archivo('archivo', $ruta );

        // Recibir el resto de datos del formulario
        $tabla    = "lista";
        $id       = intval($_POST["id"]);
        $nombre   = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $correo   = $_POST['correo'] ?? '';
        $pass     = $_POST['pass'] ?? '';
        $rol      = $_POST['rol'] ?? 0;

        $columna   = ["correo"];
        $condicion =  "correo = '$correo' AND id != '$id' ";

        $verificacion = obtener_campos($tabla, $columna , $condicion); 

        if (count($verificacion) > 0) {
            echo json_encode([
                "success" => false,
                "message" => "El correo '$correo' ya está registrado. Intenta con otro."
            ]);
            exit;
        }
        //  Insertar en la base de datos
        $condicion_col = "id"; 
        $condicion_val = $id;
        $columnas = ["nombre", "apellido", "correo", "rol"];
        $valores  = [$nombre, $apellido, $correo, $rol];
        if (!empty($_POST['pass'])) {
            $columnas[] = "pass";
            $valores[]  = password_hash($pass, PASSWORD_BCRYPT);
        }
        if (!empty($nombreArchivo)) {
            $columnas[] = "imagen";
            $valores[]  = $nombreArchivo;
        }
        $resultado= actualizar_datos($tabla, $columnas, $valores, $condicion_col, $condicion_val);

        if ($resultado) {
            echo json_encode ([
                "success" => true,
                "message" => "Registro actualizado correctamente",
                'redirect' => 'empleados_lista.php'
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