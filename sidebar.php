<?php
require_once __DIR__ . "/Conexion/funciones/auth.php";
?>

<script>
    const usuarioLogueado = "<?php echo $_SESSION['usuario']; ?>";
</script>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <link rel="stylesheet" href="sidebar.css">
    <script src="sidebar.js" defer></script>
</head>
<body>
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h2>Bienvenido</h2>
            <p id="nombreUsuario"></p>
        </div>

        <ul class="sidebar-menu">
            <li><a href="#" onclick="cargarContenido('inicio.php')">Inicio</a></li>
            <li><a href="#" onclick="cargarContenido('empleados/empleados_lista.php')">Empleados</a></li>
            <li><a href="#" onclick="cargarContenido('#')">Productos</a></li>
            <li><a href="#" onclick="cargarContenido('#')">Promociones</a></li>
            <li><a href="#" onclick="cargarContenido('#')">Pedidos</a></li>
            
        </ul>

        <button id="logoutBtn">Cerrar sesión</button>
    </div>

    <button id="toggleSidebar" class="toggle-btn">☰</button>

    <div id="main-content">
        <iframe id="contenidoFrame" name="contenidoFrame" src="inicio.php" style="width: 100%; height: 100vh; border: none;"></iframe>
    </div>

    <script>
        function cargarContenido(url) {
            if (url !== '#') {
                document.getElementById('contenidoFrame').src = url;
            }
        }
    </script>
</body>
</html>