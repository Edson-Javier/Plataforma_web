document.addEventListener("DOMContentLoaded", async () => {
    if (!productoId) {
        console.error("No se recibió ningún ID desde PHP");
        return;
    }

    const formData = new FormData();
    formData.append("id", productoId);

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
