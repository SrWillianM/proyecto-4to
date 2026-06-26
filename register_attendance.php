<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $ci = $_POST['ci'] ?? '';
    $asistencia1 = $_POST['asistencia1'] ?? '';
    $asistencia2 = $_POST['asistencia2'] ?? '';
    $asistencia3 = $_POST['asistencia3'] ?? '';
    $asistencia4 = $_POST['asistencia4'] ?? '';
    $asistencia5 = $_POST['asistencia5'] ?? '';

    if ($nombre !== '' && $ci !== '' && $asistencia1 !== '' && $asistencia2 !== '' && $asistencia3 !== '' && $asistencia4 !== '' && $asistencia5 !== '') {
        $query = 'INSERT INTO asistencia (nombre, ci, asistencia1, asistencia2, asistencia3, asistencia4, asistencia5) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('sssssss', $nombre, $ci, $asistencia1, $asistencia2, $asistencia3, $asistencia4, $asistencia5);

            if ($stmt->execute()) {
                header('Location: dashboard.php?status=success&message=Asistencia registrada');
                exit();
            }

            $stmt->close();
        }

        header('Location: dashboard.php?status=error&message=No se pudo registrar la asistencia');
        exit();
    }

    header('Location: dashboard.php?status=error&message=Todos los campos son obligatorios');
    exit();
}

header('Location: dashboard.php');
exit();