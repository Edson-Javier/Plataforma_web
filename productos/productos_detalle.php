<?php
    require_once __DIR__ . "/../Conexion/funciones/auth.php";
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formularios</title>
        <link rel="stylesheet" href="productos_formulario.css">
        <?php
            $producto_id = $_POST['producto_id'] ?? null;
        ?>
        <script>
            const productoId = <?php echo json_encode($_POST['producto_id'] ?? ''); ?>;
        </script>
        <script src="productos_detalle.js" defer></script>
    </head>

    <body>
        <div class="container" >
            <H1>Detalle</H1>
            <form 
                id="Form_detalle"
                name="Form_detalle" 
                method="post"   
                enctype="multipart/form-data"
            >
                <p>ID:</p>
                <input type="number" name="id" id="id" placeholder=""  readonly><br>
                <p>Nombre:</p>
                <input type="text" name="nombre" id="nombre" placeholder="" readonly><br>
                <p>Codigo:</p>
                <input type="text" name="codigo" id="codigo" placeholder="" readonly><br>
                <p>Costo:</p>
                <input type="number" name="costo" id="costo" step="0.01" min="0" placeholder="" readonly><br>
                <p>Stock:</p>
                <input type="number" name="stock" id="stock" placeholder="" readonly><br>
                <p>Imagen:</p>
                <div id="preview-container">
                    <span id="preview-text">No hay imagen</span>
                    <img id="preview-img" src="" alt="Vista previa" style="display:none;">
                </div>
                <p>Descripcion:</p>
                <input type="text" name="descripcion" id="descripcion" placeholder="" readonly><br>
                <p>Status:</p>
                <select name="status" id="status" disabled>
                    <option value="0">Agotado</option>
                    <option value="1">Disponible</option>
                </select><br>
                <p>Estado:</p>
                <input type="text" name="estado" id="estado" placeholder="" readonly><br>
                
                <button type="button" onclick="window.location.href='productos_lista.php'">Volver</button>

            </form>
        </div>
        <div id="mensaje"></div>
    </body>

</html>
