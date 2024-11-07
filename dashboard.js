// Selección de los botones de navegación y secciones
document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".section");
    const buttons = {
        cliente: document.getElementById("btn-cliente"),
        curso: document.getElementById("btn-curso"),
        agenda: document.getElementById("btn-agenda"),
        asistencia: document.getElementById("btn-asistencia"),
        usuarios: document.getElementById("btn-usuarios"),
        informacion: document.getElementById("btn-informacion"),
    };

    // Función para mostrar la sección seleccionada
    function showSection(sectionId) {
        // Ocultar todas las secciones y quitar la clase 'show'
        sections.forEach((section) => {
            section.style.display = "none";
            section.classList.remove("show");
        });

        // Mostrar la sección seleccionada con la clase 'show' para animación
        const selectedSection = document.getElementById(sectionId);
        selectedSection.style.display = "block";
        setTimeout(() => {
            selectedSection.classList.add("show");
        }, 10); // Pequeño retraso para que la transición se note
    }

    // Añadir event listeners a los botones de navegación
    buttons.cliente.addEventListener("click", () => showSection("cliente"));
    buttons.curso.addEventListener("click", () => showSection("curso"));
    buttons.agenda.addEventListener("click", () => showSection("agenda"));
    buttons.asistencia.addEventListener("click", () => showSection("asistencia"));
    buttons.usuarios.addEventListener("click", () => showSection("usuarios"));
    buttons.informacion.addEventListener("click", () => showSection("informacion"));
});
function showSection(sectionId) {
    // Oculta todas las secciones
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.classList.remove('active'));

    // Muestra la sección seleccionada
    const selectedSection = document.getElementById(sectionId);
    selectedSection.classList.add('active');
}

// Función para mostrar el formulario de registro de cliente
function toggleClientForm() {
    const form = document.getElementById('newClientForm');
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
}
