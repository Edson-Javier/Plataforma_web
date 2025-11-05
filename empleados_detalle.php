<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formularios</title>
        <link rel="stylesheet" href="empleados_formulario.css">
        <script src="empleados_alta.js" defer></script>
    </head>

    <body>
        <div class="container" >

            <form 
                id="Form_detalle"
                name="Form_detalle" 
                method="post"   
                enctype="multipart/form-data"
            >
                <input type="text" name="id" id="id" placeholder="Escribe tu id"  readonly><br>
                <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre"><br>
                <input type="text" name="apellido" id="apellido" placeholder="Escribe tu apellido"><br>
                <input type="text" name="correo" id="correo" placeholder="Escribe tu correo"><br>
                <input type="text" name="pass" id="pass" placeholder="Escribe tu contraseña"><br>

                <select name="rol" id="rol">
                    <option value="0">Selecciona</option>
                    <option value="1">Gerente</option>
                    <option value="2">Ejecutivo</option>
                </select><br>

                <div id="preview-container">
                    <span id="preview-text">No hay imagen</span>
                    <img id="preview-img" src="" alt="Vista previa" style="display:none;">
                </div>

                <!-- Campo para subir archivo -->
                <input type="file" name="archivo" id="archivo" accept="image/*"><br><br>

                <button type="submit">Enviar</button>
                <button type="button" onclick="window.location.href='empleados_lista.php'">Volver</button>

            </form>
        </div>
        <div id="mensaje"></div>
    </body>

</html>
