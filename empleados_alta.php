<?php

//Funcion a llamar de este archivo
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/Conexion/funciones/utilidades.php"; 

$tabla = "lista";
$id = id_nuevo($tabla);

?>

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
                id="Form_alta"
                name="Form_alta" 
                method="post"   
                enctype="multipart/form-data"
            >
                <input type="text" name="id" id="id" placeholder="<?php echo $id; ?>"  readonly><br>
                <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre"><br>
                <input type="text" name="apellido" id="apellido" placeholder="Escribe tu apellido"><br>
                <input type="text" name="correo" id="correo" placeholder="Escribe tu correo"><br>
                <input type="password" name="pass" id="pass" placeholder="Escribe tu contraseña"><br>
                <div class="checkbox-container">
                <label class="checkbox-label">
                    <input type="checkbox" id="mostrarpass">
                    <span class="checkmark"></span>
                    Mostrar contraseña
                </label>
                </div>

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
