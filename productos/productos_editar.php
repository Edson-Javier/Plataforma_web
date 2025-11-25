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
        <script src="productos_editar.js" defer></script>
    </head>

    <body>
        <div class="container" >
            <H1>Editar</H1>
            <form 
                id="form_editar"
                name="form_editar" 
                method="post"   
                enctype="multipart/form-data"
            >
                <p>ID:</p>
                <input type="number" name="id" id="id" placeholder="<?php echo $id; ?>"  readonly><br>
                <p>Nombre:</p>
                <input type="text" name="nombre" id="nombre" placeholder="Escribe su nombre"><br>
                <p>Codigo:</p>
                <input type="text" name="codigo" id="codigo" placeholder="Escribe su codigo"><br>
                <p>Costo:</p>
                <input type="number" name="costo" id="costo" step="0.01" min="0"  placeholder="Escribe su costo : 0.00"><br>
                <p>Stock:</p>
                <input type="number" name="stock" id="stock" step="1" min="0" placeholder="Escribe su numero de existencia"><br>
                <p>Imagen:</p>
                <div id="preview-container">
                    <span id="preview-text">No hay imagen</span>
                    <img id="preview-img" src="" alt="Vista previa" style="display:none;">
                </div>

                <!-- Campo para subir archivo -->
                <input type="file" name="archivo" id="archivo" accept="image/*"><br>
                <p>Descripcion:</p>
                <input type="text" name="descripcion" id="descripcion" placeholder="Escribe su descripcion"><br>


                <button type="submit">Editar</button>
                <button type="button" onclick="window.location.href='productos_lista.php'">Volver</button>

            </form>
        </div>
        <div id="mensaje"></div>
    </body>

</html>
