<?php
session_start();
include("connection.php"); // Archivo de conexión a la base de datos

// Verificar si se envió el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar el usuario en la base de datos
    $query = "SELECT * FROM usuario WHERE username = ? AND password = ?"; // Cambia 'username' y 'password' si tus columnas tienen nombres diferentes
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verificar si el usuario existe
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Guardar información del usuario en la sesión
        $_SESSION['username'] = $user['username'];
        $_SESSION['rol'] = $user['rango']; // rol de admin o instructor

        // Redirigir al dashboard
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Si las credenciales no coinciden, regresar al login con un error
        header("Location: ../index.php?error=1");
        exit();
    }
}
?>
