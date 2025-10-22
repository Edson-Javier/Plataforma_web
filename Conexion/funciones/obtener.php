<?php
require_once __DIR__ . '/../conn.php';

/**
 * Obtiene todos los registros de una tabla completa.
 */
function obtener_todos($tabla) {
    $conn = obtener_conexion();
    $sql = "SELECT * FROM $tabla";
    $result = $conn->query($sql);
    $registros = $result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    return $registros;
}

/**
 * Obtiene un registro específico según una columna y valor.
 */
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

/**
 * Obtiene registros específicos según una columna, valor y condicion.
 */

function obtener_campos($tabla, $campos, $condicion = null) {
    $conn = obtener_conexion();

    // Permite tanto array como string
    if (is_array($campos)) {
        $lista_campos = implode(", ", $campos);
    } else {
        $lista_campos = $campos;
    }

    // Construcción dinámica del SQL
    $sql = "SELECT $lista_campos FROM $tabla";
    if ($condicion) {
        $sql .= " WHERE $condicion";
    }

    $result = $conn->query($sql);
    $registros = $result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    return $registros;
}
?>
