<HTml>
    <head>
        <meta charset="UTF-8">
        <title>Listado de empleados</title>
        <link rel="stylesheet" href="empleados_formulario.css">
        <script src="index.js" defer></script>
    </head>
    <body>
        <h1>LOGIN</h1><br>
        <div class="container" >

            <form 
                id="Form_index"
                name="Form_index" 
                method="post"   
                enctype="multipart/form-data"
            >
            <input type="text" name="correo" id="correo" placeholder="Escribe tu correo"><br>
            <input type="text" name="pass" id="pass" placeholder="Escribe tu contraseña"><br>
            <br>
            <button type="submit">Enviar</button>
        </form>
        <br>
    </div>
        <div id="mensaje"></div>
    </body>
</HTml>