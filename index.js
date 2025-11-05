document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("Form_index");
    const mensaje = document.getElementById("mensaje");
    // --- Mostrar / ocultar contraseña ---
    const passInput = document.getElementById("pass");
    const mostrarPass = document.getElementById("mostrarpass");

    if (mostrarPass && passInput) {
        mostrarPass.addEventListener("change", () => {
            passInput.type = mostrarPass.checked ? "text" : "password";
        });
    }


    // --- Envío del formulario con AJAX ---
    form.addEventListener("submit", async (e) => {
        e.preventDefault(); // Evita el envío normal
        mensaje.innerHTML = "";
        mensaje.className = "";

        // Obtener valores

        const correo   = form.correo.value.trim();
        const pass     = form.pass.value.trim();

        // Validación de campos
        const errores = [];

        if (!correo) errores.push("Falta el correo.");
        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) errores.push("Correo inválido.");
        if (!pass) errores.push("Falta la contraseña.");
        else if (pass.length < 6) errores.push("Contraseña mínima 6 caracteres.");

        if (errores.length > 0) {
            mensaje.innerHTML = errores.map(e => `<p>${e}</p>`).join("");
            mensaje.classList.add("error-mensaje");
            setTimeout(() => mensaje.innerHTML = "", 5000);
            return;
        }

        // Preparar envío con FormData
        const formData = new FormData(form);

        try {
            const response = await fetch("procesar_index.php", {
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
            if (data.success && data.redirect) {
                form.reset();
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
