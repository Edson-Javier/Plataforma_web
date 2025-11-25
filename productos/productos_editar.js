document.addEventListener("DOMContentLoaded", async () => {
    if (!productoId) {
        console.error("No se recibió ningún ID desde PHP");
        return;
    }

    const formData = new FormData();
    formData.append("accion", "obtener");
    formData.append("id", productoId);

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
        document.getElementById("codigo").value = data.codigo || "";
        document.getElementById("costo").value = data.costo || "";
        document.getElementById("stock").value = data.stock || "";
        document.getElementById("descripcion").value = data.descripcion || "";

        // Mostrar imagen
        const previewImg = document.getElementById("preview-img");
        const previewText = document.getElementById("preview-text");

        if (data.imagen) {
            previewImg.src = `../archivos/productos/${data.imagen}`;
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
        const id          = form.querySelector("#id").value.trim();
        const nombre      = form.nombre.value.trim();
        const codigo      = form.codigo.value.trim();
        const costo       = form.costo.value.trim();
        const stock       = form.stock.value.trim();
        const archivo     = form.archivo.value;
        const descripcion = form.descripcion.value.trim

        // Validación de campos
        const errores = [];
        if (!nombre)      errores.push("Falta el nombre.");
        if (!codigo)      errores.push("Falta el codigo.");
        if (!costo)       errores.push("Falta el costo.");
        if (!stock)       errores.push("Falta el numero de existencia.");
        //if (!archivo)     errores.push("Falta la imagen del producto.");
        if (!descripcion) errores.push("Debes de brindar una descripcion.");

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
