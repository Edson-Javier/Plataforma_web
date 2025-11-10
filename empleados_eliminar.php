<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formularios</title>
        <link rel="stylesheet" href="empleados_formulario.css">
        <?php
            $empleado_id = $_POST['empleado_id'] ?? null;
        ?>
        <script>
            const empleadoId = <?php echo json_encode($_POST['empleado_id'] ?? ''); ?>;
        </script>
        <script src="empleados_eliminar.js" defer></script>
    </head>

    <body>
        <div class="container" >
            <H1>Eliminar</H1>
            <form 
                id="form_eliminar"
                name="form_eliminar" 
                method="post"   
                enctype="multipart/form-data"
            >
                <input type="text" name="id" id="id" placeholder=""  readonly><br>
                <input type="text" name="nombre" id="nombre" placeholder="" readonly><br>
                <input type="text" name="apellido" id="apellido" placeholder="" readonly><br>
                <input type="text" name="correo" id="correo" placeholder="" readonly><br>
                <input type="text" name="estado" id="estado" placeholder="" readonly><br>

                <select name="rol" id="rol" disabled>
                    <option value="0">Selecciona</option>
                    <option value="1">Gerente</option>
                    <option value="2">Ejecutivo</option>
                </select><br>

                <div id="preview-container">
                    <span id="preview-text">No hay imagen</span>
                    <img id="preview-img" src="" alt="Vista previa" style="display:none;">
                </div>
                <button type="submit">Eliminar</button>
                <button type="button" onclick="window.location.href='empleados_lista.php'">Volver</button>

            </form>
        </div>
        <div id="mensaje"></div>
    </body>

</html>
