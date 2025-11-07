document.addEventListener("DOMContentLoaded", async () => {
    if (!empleadoId) {
        console.error("No se recibió ningún ID desde PHP");
        return;
    }

    const formData = new FormData();
    formData.append("id", empleadoId);

    try {
        const response = await fetch("procesar_detalle.php", {
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
        document.getElementById("estado").value = data.eliminar || "";
        document.getElementById("rol").value = data.rol || "0";

        // Mostrar imagen
        const previewImg = document.getElementById("preview-img");
        const previewText = document.getElementById("preview-text");

        if (data.imagen) {
            previewImg.src = `/archivos/${data.imagen}`;
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
