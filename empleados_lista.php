<?php

//Funcion a llamar de este archivo
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/Conexion/funciones/obtener.php"; 

//Variables para la llamada a la base de datos

$tabla = "lista";
$campos = ["id", "nombre", "apellido", "correo", "rol"];
$condicion = "eliminar = 0";

$empleados = obtener_campos($tabla, $campos , $condicion);

// Contar el total
$total = count($empleados);

//Revela el rol del usuario
function revela_rol($rol) {
    $roles = [
        1 => "Ejecutivo",
        2 => "Gerente"
    ];

    return $roles[$rol] ?? "Desempleado"; 
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de empleados</title>
    <link rel="stylesheet" href="empleados_lista.css">
</head>
<body>
    <div class="container">
        <h1>Listado de empleados (<?php echo $total; ?>)</h1>
        <a class="btn" href="empleados_alta.php">Crear nuevo registro</a>
        <a class="btn" href="empleados_detalle.php">Ver detalles de registro</a>
        <a class="btn" href="empleados_editar.php">Editar registro</a>
        <a class="btn" href="empleados_eliminar.php">Eliminar registro</a>
        
        <div class="tabla-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($total > 0): ?>
                        <?php foreach ($empleados as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row["id"]); ?></td>
                                <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                                <td><?php echo htmlspecialchars($row["apellido"]);  ?></td>
                                <td><?php echo htmlspecialchars($row["correo"]); ?></td>
                                <td><?php echo revela_rol($row["rol"]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No hay empleados registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

