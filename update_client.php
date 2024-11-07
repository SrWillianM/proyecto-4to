<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nacionalidad = $_POST['nacionalidad'];
    $domicilio = $_POST['domicilio'];
    $telefono = $_POST['telefono'];

    $query = "UPDATE cliente SET nombre = ?, apellido = ?, nacionalidad = ?, domicilio = ?, telefono = ? WHERE ci = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $nombre, $apellido, $nacionalidad, $domicilio, $telefono, $ci);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?status=success&message=Cliente actualizado");
    } else {
        header("Location: ../dashboard.php?status=error&message=Error al actualizar cliente");
    }
}
?>
