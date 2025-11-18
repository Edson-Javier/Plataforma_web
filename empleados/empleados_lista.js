// Capturar filas de la tabla
const filas = document.querySelectorAll('#tablaEmpleados tbody tr');

// Inputs ocultos de los formularios
const detalleInput = document.getElementById('detalle_id');
const editarInput = document.getElementById('editar_id');
const eliminarInput = document.getElementById('eliminar_id');

filas.forEach(fila => {
    fila.addEventListener('click', () => {
        const id = fila.dataset.id;

        // Guardar ID en todos los formularios
        detalleInput.value = id;
        editarInput.value = id;
        eliminarInput.value = id;

        // Resaltar fila seleccionada
        filas.forEach(f => f.classList.remove('seleccionada'));
        fila.classList.add('seleccionada');
    });
});

function verificarSeleccion(formId) {
    const form = document.getElementById(formId);
    const input = form.querySelector('input[name="empleado_id"]');

    if (!input.value) {
        alert("Por favor selecciona un empleado primero.");
        return false;
    }
    return true;
}