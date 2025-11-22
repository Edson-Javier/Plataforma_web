document.addEventListener("DOMContentLoaded", async () => {
    if (!empleadoId) {
        console.error("No se recibió ningún ID desde PHP");
        return;
    }

    const formData = new FormData();
    formData.append("accion", "obtener");
    formData.append("id", empleadoId);

    try {
        const response = await fetch("procesar_editar.php", {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        if (data.error) {
            console.error(data.error);
            return;
        }

        // Llenar el formulario
        document.getElementById("id").value = data.id || "";
        document.getElementById("nombre").value = data.nombre || "";
        document.getElementById("apellido").value = data.apellido || "";
        document.getElementById("correo").value = data.correo || "";

        document.getElementById("rol").value = data.rol || "0";

        // Mostrar imagen
        const previewImg = document.getElementById("preview-img");
        const previewText = document.getElementById("preview-text");

        if (data.imagen) {
            previewImg.src = `../archivos/empleados/${data.imagen}`;
            previewImg.style.display = "block";
            previewText.style.display = "none";
        } else {
            previewImg.style.display = "none";
            previewText.style.display = "block";
        }

    } catch (err) {
        console.error("Error al obtener datos:", err);
    }
});


document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form_editar");
    const mensaje = document.getElementById("mensaje");

    // --- Mostrar / ocultar contraseña ---
    const passInput = document.getElementById("pass");
    const mostrarPass = document.getElementById("mostrarpass");

    if (mostrarPass && passInput) {
        mostrarPass.addEventListener("change", () => {
            passInput.type = mostrarPass.checked ? "text" : "password";
        });
    }

    // --- Previsualización de imagen ---
    const archivoInput = document.getElementById("archivo");
    const previewImg = document.getElementById("preview-img");
    const previewText = document.getElementById("preview-text");

    archivoInput.addEventListener("change", () => {
        const file = archivoInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                previewImg.style.display = "block";
                previewText.style.display = "none";
            };
            reader.readAsDataURL(file);
        } else {
            previewImg.style.display = "none";
            previewText.style.display = "block";
        }
    });

    // --- Envío del formulario con AJAX ---
    form.addEventListener("submit", async (e) => {
        e.preventDefault(); // Evita el envío normal
        mensaje.innerHTML = "";

        // Obtener valores
        const id       = form.querySelector("#id").value.trim();
        const nombre   = form.nombre.value.trim();
        const apellido = form.apellido.value.trim();
        const correo   = form.correo.value.trim();
        const pass     = form.pass.value.trim();
        const rol      = form.rol.value;
        const archivo  = form.archivo.value;

        // Validación de campos
        const errores = [];
        if (!nombre) errores.push("Falta el nombre.");
        if (!apellido) errores.push("Falta el apellido.");
        if (!correo) errores.push("Falta el correo.");
        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) errores.push("Correo inválido.");
        //if (!pass) errores.push("Falta la contraseña.");
        else if (pass != "" && pass.length < 6) errores.push("Contraseña mínima 6 caracteres.");
        if (rol === "0") errores.push("Debes seleccionar un rol.");
        //if (!archivo) errores.push("Falta la foto del usuario.");

        if (errores.length > 0) {
            mensaje.innerHTML = errores.map(e => `<p>${e}</p>`).join("");
            mensaje.classList.add("error-mensaje");
            setTimeout(() => mensaje.innerHTML = "", 5000);
            return;
        }

        // Preparar envío con FormData
        const formData = new FormData(form);
        formData.append("accion", "actualizar");


        try {
            const response = await fetch("procesar_editar.php", {
                method: "POST",
                body: formData
            });

            const text = await response.text();
            let data;

            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error(" Respuesta no válida JSON, recibido:", text);
                mensaje.innerHTML = `<p>Error del servidor:<br>${text}</p>`;
                mensaje.classList.add("error-mensaje");
                return;
            }


            // Mostrar resultado
            mensaje.innerHTML = `<p>${data.message}</p>`;
            mensaje.classList.add(data.success ? "exito-mensaje" : "error-mensaje");

            // Limpiar formulario si fue exitoso
            if (data.success) {
                setTimeout(() => {
                        window.location.href = data.redirect;
                }, 1000);
            }

            // Borrar mensaje después de 5s
            setTimeout(() => mensaje.innerHTML = "", 5000);

        } catch (error) {
            console.error("Error:", error);
            mensaje.innerHTML = `<p>Error al enviar los datos.</p>`;
            mensaje.classList.add("error-mensaje");
            setTimeout(() => mensaje.innerHTML = "", 5000);
        }
    });
});
