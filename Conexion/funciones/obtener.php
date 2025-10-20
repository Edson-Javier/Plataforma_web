<?php
require_once __DIR__ . '/../conn.php';

function obtener_todos($tabla) {
    $conn = obtener_conexion();
    $sql = "SELECT * FROM $tabla";
    $result = $conn->query($sql);
    $registros = $result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    return $registros;
}

function obtener_por_id($tabla, $columna, $valor) {
    $conn = obtener_conexion();
    $sql = "SELECT * FROM $tabla WHERE $columna = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $valor);
    $stmt->execute();

    $resultado = $stmt->get_result()->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $resultado;
}
?>
