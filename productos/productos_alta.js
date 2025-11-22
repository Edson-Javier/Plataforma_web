document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("Form_alta");
    const mensaje = document.getElementById("mensaje");

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
        const nombre      = form.nombre.value.trim();
        const codigo      = form.codigo.value.trim();
        const costo       = form.costo.value.trim();
        const stock       = form.stock.value.trim();
        const archivo     = form.archivo.value;
        const descripcion = form.descripcion.value.trim();

        // Validación de campos
        const errores = [];
        if (!nombre)      errores.push("Falta el nombre.");
        if (!codigo)      errores.push("Falta el codigo.");
        if (!costo)       errores.push("Falta el costo.");
        if (!stock)       errores.push("Falta el numero de existencia.");
        if (!archivo)     errores.push("Falta la imagen del producto.");
        if (!descripcion) errores.push("Debes de brindar una descripcion.");

        if (errores.length > 0) {
            mensaje.innerHTML = errores.map(e => `<p>${e}</p>`).join("");
            mensaje.classList.add("error-mensaje");
            setTimeout(() => mensaje.innerHTML = "", 5000);
            return;
        }

        // Preparar envío con FormData
        const formData = new FormData(form);

        try {
            const response = await fetch("procesar_alta.php", {
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
                form.reset();
                form.id.placeholder = data.nuevo_id;
                previewImg.style.display = "none";
                previewText.style.display = "block"; // Resetear preview
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
