<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function guardar_archivo($campo = 'archivo', $carpeta = 'archivos/')
{
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        return null; // No se subió archivo o hubo error
    }

    $nombre_real = $_FILES[$campo]['name'];
    $archivo_temporal = $_FILES[$campo]['tmp_name'];

    // Obtener extensión
    $extension = pathinfo($nombre_real, PATHINFO_EXTENSION);

    // Crear nombre único en base a hash
    $encriptado = md5_file($archivo_temporal);
    $nuevo_nombre = "$encriptado.$extension";

    // Verificar carpeta destino
    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    // Copiar archivo
    if (copy($archivo_temporal, $carpeta . $nuevo_nombre)) {
        return $nuevo_nombre; 
    } else {
        return null; // 
    }
}
?>
