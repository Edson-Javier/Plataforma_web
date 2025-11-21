<?php

//Funcion a llamar de este archivo
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../Conexion/funciones/obtener.php";
require_once __DIR__ . "/..//Conexion/funciones/auth.php";


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

        <a class="btn" href="empleados_alta.php">Crear registro</a>

        <!--Fromularios para botones que necesitan ID -->
        
        <form id="form_detalle" action="empleados_detalle.php" method="POST" style="display:inline;"
        onsubmit="return verificarSeleccion('form_detalle')">
            <input type="hidden" name="empleado_id" id="detalle_id">
            <button type="submit" class="btn">Ver detalles</button>
        </form>
        
        <form id="form_editar" action="empleados_editar.php" method="POST" style="display: inline;"
        onsubmit="return verificarSeleccion('form_editar')">
            <input type="hidden" name="empleado_id" id="editar_id">
            <button type="submit" class="btn" >Editar registro</button>
        </form>


        <form id="form_eliminar" action="empleados_eliminar.php" method="POST" style="display:inline;"
        onsubmit="return verificarSeleccion('form_eliminar')">
            <input type="hidden" name="empleado_id" id="eliminar_id">
            <button type="submit" class="btn">Eliminar registro</button>
        </form>
        
        <div class="tabla-container">
            <table id="tablaEmpleados" >
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
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td><?php echo htmlspecialchars($row["id"]); ?></td>
                                <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                                <td><?php echo htmlspecialchars($row["apellido"]);  ?></td>
                                <td><?php echo htmlspecialchars($row["correo"]); ?></td>
                                <td><?php echo revela_rol($row["rol"]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay empleados registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="empleados_lista.js"></script>

</body>
</html>

