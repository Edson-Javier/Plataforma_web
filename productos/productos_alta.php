<?php

//Funcion a llamar de este archivo
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../Conexion/funciones/utilidades.php";
require_once __DIR__ . "/../Conexion/funciones/auth.php"; 

$tabla = "lista";
$id = id_nuevo($tabla);

?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formularios</title>
        <link rel="stylesheet" href="productos_formulario.css">
        <script src="productos_alta.js" defer></script>
    </head>

    <body>
        <div class="container" >
            <H1>Alta</H1>
            <form 
                id="Form_alta"
                name="Form_alta" 
                method="post"   
                enctype="multipart/form-data"
            >
                <input type="number" name="id" id="id" placeholder="<?php echo $id; ?>"  readonly><br>
                <input type="text" name="nombre" id="nombre" placeholder="Escribe su nombre"><br>
                <input type="text" name="codigo" id="codigo" placeholder="Escribe su codigo"><br>
                <input type="number" name="costo" id="costo" step="0.01" min="0"  placeholder="Escribe su costo : 0.00"><br>
                <input type="number" name="stock" id="stock" step="1" min="0" placeholder="Escribe su numero de existencia"><br>

                <div id="preview-container">
                    <span id="preview-text">No hay imagen</span>
                    <img id="preview-img" src="" alt="Vista previa" style="display:none;">
                </div>

                <!-- Campo para subir archivo -->
                <input type="file" name="archivo" id="archivo" accept="image/*"><br>

                <input type="text" name="descripcion" id="descripcion" placeholder="Escribe su descripcion"><br>


                <button type="submit">Enviar</button>
                <button type="button" onclick="window.location.href='empleados_lista.php'">Volver</button>

            </form>
        </div>
        <div id="mensaje"></div>
    </body>

</html>
