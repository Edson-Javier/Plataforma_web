<?php
require_once __DIR__ . '/../conn.php';

function eliminar_datos($tabla, $columna, $valor) {
    $conn = obtener_conexion();

    $sql = "DELETE FROM $tabla WHERE $columna = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $valor);

    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado;
}
?>
