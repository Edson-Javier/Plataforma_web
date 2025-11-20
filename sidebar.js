document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");
    const nombreUsuario = document.getElementById("nombreUsuario");
    const logoutBtn = document.getElementById("logoutBtn");

    // Mostrar el nombre del usuario
    if (typeof usuarioLogueado !== "undefined") {
        nombreUsuario.textContent = usuarioLogueado;
    }

    // Abrir / cerrar sidebar
    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });

    // Cerrar sesión
    logoutBtn.addEventListener("click", () => {
        window.location.href = "Conexion/funciones/logout.php";
    });
});