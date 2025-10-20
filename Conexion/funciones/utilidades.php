<?php
require_once __DIR__ . '/../conn.php';

function id_nuevo($tabla) {
    $conn = obtener_conexion();
    $sql = "SELECT MAX(id) AS max_id FROM $tabla";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $conn->close();

    return ($row['max_id'] ?? 0) + 1;
}
?>
