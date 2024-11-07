<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el CI desde el formulario
    $search_ci = $_POST['search_ci'];

    // Consulta para buscar al cliente por su cédula
    $query = "SELECT * FROM cliente WHERE ci LIKE ?";
    $stmt = $conn->prepare($query);
    $search_term = "%" . $search_ci . "%"; // Usar % para hacer una búsqueda parcial
    $stmt->bind_param("s", $search_term);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró algún cliente
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Cédula</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';
        echo '<th>Nacionalidad</th>';
        echo '<th>Domicilio</th>';
        echo '<th>Teléfono</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Mostrar los resultados en la tabla
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['ci'] . '</td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['apellido'] . '</td>';
            echo '<td>' . $row['nacionalidad'] . '</td>';
            echo '<td>' . $row['domicilio'] . '</td>';
            echo '<td>' . $row['telefono'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p>No se encontraron resultados para la cédula: " . htmlspecialchars($search_ci) . "</p>";
    }
}
?>
