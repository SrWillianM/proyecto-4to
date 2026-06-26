<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Santo Tomás Escuela de Conducción</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styledb.css">
    <style>
        /* Agregar clases para ocultar/mostrar las secciones */
        .section {
            display: none;
        }
        .active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Santo Tomás</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row">
            <!-- Menú lateral -->
            <div class="col-md-3 bg-light p-4">
                <h5 class="text-center mb-4">Menú</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('cliente')">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('curso')">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('agenda')">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('asistencia')">Asistencia</a>
                    </li>
                    <?php if ($_SESSION['rol'] == 'admin') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('usuarios')">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('informacion')">Información de Empresa</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- Contenido Principal -->
            <div class="col-md-9 p-4">
                <?php if (isset($_GET['status']) && isset($_GET['message'])) : ?>
                    <div class="alert alert-<?php echo $_GET['status'] === 'success' ? 'success' : 'danger'; ?>">
                        <?php echo htmlspecialchars($_GET['message']); ?>
                    </div>
                <?php endif; ?>
                <!-- Sección Clientes -->
                <div id="cliente" class="section active">
                    <h3>Clientes</h3>
                    <form id="searchClientForm" class="form-inline mb-3" action="search_client.php" method="POST" onsubmit="return submitSearch(this, 'searchResults');">
                        <input type="text" name="search_ci" id="search_ci_cliente" class="form-control mr-2" placeholder="Buscar por CI" required>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                    <div id="searchResults"></div>
                    <button class="btn btn-success mb-3" onclick="toggleClientForm()">Nuevo Cliente</button>
                    <div id="newClientForm" style="display:none;">
                        <form action="register_client.php" method="POST">
                            <div class="form-group">
                                <label for="ci">Cédula de Identidad</label>
                                <input type="text" name="ci" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nacionalidad">Nacionalidad</label>
                                <input type="text" name="nacionalidad" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="domicilio">Domicilio</label>
                                <input type="text" name="domicilio" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Cliente</button>
                        </form>
                    </div>
                </div>
                <!-- Sección de Cursos -->
                <div id="curso" class="section">
                    <h3>Curso</h3>
                    <form action="register_course.php" method="POST">
                        <div class="form-group">
                            <label for="cedula_cliente">Cédula del Cliente</label>
                            <input type="text" name="cedula_cliente" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoría del Curso</label>
                            <select name="categoria" class="form-control" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="B Superior">B Superior</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin</label>
                            <input type="date" name="fecha_fin" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar en Curso</button>
                    </form>
                </div>
                <!-- Sección de Agenda -->
                <div id="agenda" class="section">
                    <h3>Agenda</h3>
                    <form id="searchAgendaForm" class="form-inline mb-3" action="search_client.php" method="POST" onsubmit="return submitSearch(this, 'searchResultsAgenda');">
                        <input type="text" name="search_ci" id="search_ci_agenda" class="form-control mr-2" placeholder="Buscar por CI" required>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                    <div id="searchResultsAgenda"></div>
                    <button class="btn btn-success mb-3" onclick="toggleAgendaForm()">Nueva Agenda</button>
                    <div id="newAgendaForm" style="display:none;">
                        <form action="agenda.php" method="POST">
                            <div class="form-group">
                                <label for="ci_cliente">Cédula de Identidad del Cliente</label>
                                <input type="text" name="ci_cliente" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoría del Curso</label>
                                <select name="categoria" class="form-control" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="B Superior">B Superior</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_fin">Fecha de Fin</label>
                                <input type="date" name="fecha_fin" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar en Agenda</button>
                        </form>
                    </div>
                </div>
                <!-- Sección de Asistencia -->
                <div id="asistencia" class="section">
                    <h3>Asistencia</h3>
                    <form action="register_attendance.php" method="POST">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cédula</th>
                                    <th>Clase 1</th>
                                    <th>Clase 2</th>
                                    <th>Clase 3</th>
                                    <th>Clase 4</th>
                                    <th>Clase 5</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="nombre" value="Nombre Cliente" readonly></td>
                                    <td><input type="text" name="ci" value="CI Cliente" readonly></td>
                                    <td><select name="asistencia1" class="form-control"><option value="Presente">Presente</option><option value="Ausente">Ausente</option></select></td>
                                    <td><select name="asistencia2" class="form-control"><option value="Presente">Presente</option><option value="Ausente">Ausente</option></select></td>
                                    <td><select name="asistencia3" class="form-control"><option value="Presente">Presente</option><option value="Ausente">Ausente</option></select></td>
                                    <td><select name="asistencia4" class="form-control"><option value="Presente">Presente</option><option value="Ausente">Ausente</option></select></td>
                                    <td><select name="asistencia5" class="form-control"><option value="Presente">Presente</option><option value="Ausente">Ausente</option></select></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                    </form>
                </div>
                <!-- Sección de Información de Empresa (Solo para Admin) -->
                <div id="informacion" class="section">
                    <h3>Información de la Empresa</h3>
                    <p>Detalles sobre la empresa...</p>
                </div>
                <!-- Sección Usuarios (Solo para Admin) -->
                <div id="usuarios" class="section">
                    <h3>Usuarios</h3>
                    <p>Aquí se gestionan los usuarios...</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Función para mostrar y ocultar secciones
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active'));
            document.getElementById(sectionId).classList.add('active');
        }

        async function submitSearch(form, resultId) {
            const resultContainer = document.getElementById(resultId);
            resultContainer.innerHTML = '<div class="alert alert-info mb-0">Buscando...</div>';

            try {
                const response = await fetch(form.action, {
                    method: form.method,
                    body: new FormData(form)
                });

                resultContainer.innerHTML = await response.text();
            } catch (error) {
                resultContainer.innerHTML = '<div class="alert alert-danger mb-0">No se pudo completar la búsqueda.</div>';
            }

            return false;
        }
        // Función para mostrar el formulario de nuevo cliente
        function toggleClientForm() {
            const form = document.getElementById('newClientForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
        // Función para mostrar el formulario de nueva agenda
        function toggleAgendaForm() {
            const form = document.getElementById('newAgendaForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
  