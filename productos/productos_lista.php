<?php

//Funcion a llamar de este archivo
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../Conexion/funciones/obtener.php";
require_once __DIR__ . "/..//Conexion/funciones/auth.php";


//Variables para la llamada a la base de datos

$tabla = "productos";
$campos = ["id", "nombre", "codigo", "costo", "stock", "status"];
$condicion = "eliminar = 0";

$productos = obtener_campos($tabla, $campos , $condicion);

// Contar el total
$total = count($productos);

//Revela el rol del usuario
function revela_status($rol) {
    $roles = [
        0 => "Agotado",
        1 => "Disponible"
    ];

    return $roles[$rol] ?? "Desconocido"; 
} 
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="productos_lista.css">
</head>
<body>
    <div class="container">
        <h1>Listado de productos (<?php echo $total; ?>)</h1>

        <a class="btn" href="productos_alta.php">Crear registro</a>

        <!--Fromularios para botones que necesitan ID -->
        
        <form id="form_detalle" action="productos_detalle.php" method="POST" style="display:inline;"
        onsubmit="return verificarSeleccion('form_detalle')">
            <input type="hidden" name="producto_id" id="detalle_id">
            <button type="submit" class="btn">Ver detalles</button>
        </form>
        
        <form id="form_editar" action="productos_editar.php" method="POST" style="display: inline;"
        onsubmit="return verificarSeleccion('form_editar')">
            <input type="hidden" name="producto_id" id="editar_id">
            <button type="submit" class="btn" >Editar registro</button>
        </form>


        <form id="form_eliminar" action="productos_eliminar.php" method="POST" style="display:inline;"
        onsubmit="return verificarSeleccion('form_eliminar')">
            <input type="hidden" name="producto_id" id="eliminar_id">
            <button type="submit" class="btn">Eliminar registro</button>
        </form>
        
        <div class="tabla-container">
            <table id="tablaProductos" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Costo</th>
                        <th>Stock</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($total > 0): ?>
                        <?php foreach ($productos as $row): ?>
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td><?php echo htmlspecialchars($row["id"]); ?></td>
                                <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                                <td><?php echo htmlspecialchars($row["codigo"]);  ?></td>
                                <td><?php echo htmlspecialchars($row["costo"]);  ?></td>
                                <td><?php echo htmlspecialchars($row["stock"]); ?></td>
                                <td><?php echo revela_status($row["status"]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No hay productos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="productos_lista.js"></script>

</body>
</html>

