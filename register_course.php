<?php
include("connection.php");

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $cedula_cliente = $_POST['cedula_cliente'];
    $categoria = $_POST['categoria'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Validar que todos los campos estén completos
    if (!empty($cedula_cliente) && !empty($categoria) && !empty($fecha_inicio) && !empty($fecha_fin)) {
        
        // Verificar si el cliente existe
        $sql_cliente = "SELECT id_cliente FROM Cliente WHERE cedula = ?";
        if ($stmt = $conn->prepare($sql_cliente)) {
            $stmt->bind_param("s", $cedula_cliente);
            $stmt->execute();
            $result = $stmt->get_result();

            // Si el cliente existe, registrar el curso
            if ($result->num_rows > 0) {
                $cliente = $result->fetch_assoc();
                $id_cliente = $cliente['id_cliente'];

                // Preparar la consulta SQL para insertar el curso en la tabla Cursante
                $sql_curso = "INSERT INTO Cursante (id_cliente, categoria, fecha_inicio, fecha_fin) 
                              VALUES (?, ?, ?, ?)";
                if ($stmt_curso = $conn->prepare($sql_curso)) {
                    $stmt_curso->bind_param("ssss", $id_cliente, $categoria, $fecha_inicio, $fecha_fin);
                    
                    // Ejecutar la consulta
                    if ($stmt_curso->execute()) {
                        $_SESSION['success_message'] = "Curso registrado con éxito.";
                        header("Location: ../dashboard.php"); // Redirigir al dashboard con mensaje de éxito
                        exit();
                    } else {
                        $_SESSION['error_message'] = "Error al registrar el curso. Intenta nuevamente.";
                        header("Location: ../dashboard.php"); // Redirigir en caso de error
                        exit();
                    }
                    $stmt_curso->close();
                } else {
                    $_SESSION['error_message'] = "Error en la preparación de la consulta de curso.";
                    header("Location: ../dashboard.php");
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Cliente no encontrado. Verifica la cédula.";
                header("Location: ../dashboard.php");
                exit();
            }

            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Error al buscar el cliente.";
            header("Location: ../dashboard.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Todos los campos son obligatorios.";
        header("Location: ../dashboard.php"); // Redirigir si algún campo está vacío
        exit();
    }
}

$conn->close();
?>
