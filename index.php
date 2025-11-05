<HTml>
    <head>
        <meta charset="UTF-8">
        <title>Listado de empleados</title>
        <link rel="stylesheet" href="empleados_formulario.css">
        <script src="index.js" defer></script>
    </head>
    <body>
        <div class="container" >
            <h1>LOGIN</h1><br>
            <form 
                id="Form_index"
                name="Form_index" 
                method="post"   
                enctype="multipart/form-data"
            >
            <input type="text" name="correo" id="correo" placeholder="Escribe tu correo"><br>
            <input type="password" name="pass" id="pass" placeholder="Escribe tu contraseña"><br>
            <div class="checkbox-container">
            <label class="checkbox-label">
                <input type="checkbox" id="mostrarpass">
                <span class="checkmark"></span>
                Mostrar contraseña
            </label>
            </div>
            <br>
            <button type="submit">Enviar</button>
        </form>
        <br>
    </div>
        <div id="mensaje"></div>
    </body>

</HTml>