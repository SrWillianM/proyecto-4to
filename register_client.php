<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nacionalidad = $_POST['nacionalidad'];
    $domicilio = $_POST['domicilio'];
    $telefono = $_POST['telefono'];

    $query = "INSERT INTO cliente (ci, nombre, apellido, nacionalidad, domicilio, telefono) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $ci, $nombre, $apellido, $nacionalidad, $domicilio, $telefono);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?status=success&message=Cliente registrado");
    } else {
        header("Location: ../dashboard.php?status=error&message=Error al registrar cliente");
    }
}
?>
