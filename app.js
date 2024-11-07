function showSection(sectionId) {
    // Ocultar todas las secciones
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.style.display = 'none');
    
    // Mostrar la sección seleccionada
    document.getElementById(sectionId).style.display = 'block';
    
}
function toggleClientForm() {
    var form = document.getElementById("newClientForm");
    form.style.display = form.style.display === "none" ? "block" : "none";
}
