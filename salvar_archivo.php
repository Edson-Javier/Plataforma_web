<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$nombre_real = $_FILES['archivo']['name'];
$archivo_temporal = $_FILES['archivo']['tmp_name'];

$arreglo =explode(".",$nombre_real);
$len = count($arreglo);
$pos = $len - 1;
$extension = $arreglo[$pos];

$carpeta = "archivos/";

$encriptado = md5_file($archivo_temporal);
$nuevo_nombre = "$encriptado.$extension";

echo "Nombre real -> $nombre_real <br>";
echo "Archivo temporal -> $archivo_temporal <br>";
echo "Extension -> $extension <br>";
echo "Encriptado -> $encriptado <br>";
echo "Nuevo nombre -> $nuevo_nombre <br>";

copy($archivo_temporal, $carpeta.$nuevo_nombre);
?>