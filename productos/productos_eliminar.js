document.addEventListener("DOMContentLoaded", async () => {
    if (!productoId) {
        console.error("No se recibió ningún ID desde PHP");
        return;
    }

    const formData = new FormData();
    formData.append("accion", "obtener");
    formData.append("id", productoId);

    try {
        const response = await fetch("procesar_eliminar.php", {
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
        document.getElementById("status").value = data.status || "";
        
        if (data.eliminar == 0) {
         document.getElementById("estado").value = "Estado : ACTIVO" || "";   
        }else{
            document.getElementById("estado").value = "Estado : INACTIVO" || "";
        }

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
    const form = document.getElementById("form_eliminar");
    const mensaje = document.getElementById("mensaje");
    
    form.addEventListener("submit", async (e) => {
        e.preventDefault(); // Evita el envío normal
        mensaje.innerHTML = "";

        const id = form.querySelector("#id").value.trim();

        if (!id) {
            mensaje.innerHTML = "<p>No se encontró el ID del registro.</p>";
            mensaje.classList.add("error-mensaje");
            return;
        }
        
        const confirmar = confirm("¿Estás seguro de que deseas eliminar este producto?");
        if (!confirmar) {
            return; // Si el usuario cancela, no hace nada
        }
        const formData = new FormData();
        formData.append("accion", "eliminar");
        formData.append("id", id);


        try {
            const response = await fetch("procesar_eliminar.php", {
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