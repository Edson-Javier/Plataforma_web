<?php
require_once __DIR__ . '/../conn.php';

function insertar_datos($tabla, $columnas, $valores) {
    $conn = obtener_conexion();

    $cols = implode(", ", $columnas);
    $placeholders = implode(", ", array_fill(0, count($valores), "?"));

    $sql = "INSERT INTO $tabla ($cols) VALUES ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat("s", count($valores)), ...$valores);

    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado;
}
?>
