<?php
require_once __DIR__ . '/../conn.php';

function actualizar_datos($tabla, $columnas, $valores, $condicion_col, $condicion_val) {
    $conn = obtener_conexion();

    $set_clause = implode(", ", array_map(fn($c) => "$c = ?", $columnas));
    $sql = "UPDATE $tabla SET $set_clause WHERE $condicion_col = ?";
    $stmt = $conn->prepare($sql);

    $valores[] = $condicion_val;
    $stmt->bind_param(str_repeat("s", count($valores)), ...$valores);

    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado;
}
?>
