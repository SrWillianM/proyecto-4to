<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ci_cliente = $_POST['ci_cliente'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';

    if ($ci_cliente !== '' && $categoria !== '' && $fecha_inicio !== '' && $fecha_fin !== '') {
        $sql_cliente = "SELECT id_cliente FROM cliente WHERE ci = ?";
        $stmt = $conn->prepare($sql_cliente);

        if ($stmt) {
            $stmt->bind_param('s', $ci_cliente);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $cliente = $result->fetch_assoc();
                $id_cliente = $cliente['id_cliente'];

                $sql_agenda = "INSERT INTO agenda (id_cliente, categoria, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)";
                $stmt_agenda = $conn->prepare($sql_agenda);

                if ($stmt_agenda) {
                    $stmt_agenda->bind_param('isss', $id_cliente, $categoria, $fecha_inicio, $fecha_fin);

                    if ($stmt_agenda->execute()) {
                        header('Location: dashboard.php?status=success&message=Agenda registrada');
                        exit();
                    }

                    $stmt_agenda->close();
                }

                $_SESSION['error_message'] = 'No se pudo registrar la agenda.';
            } else {
                $_SESSION['error_message'] = 'Cliente no encontrado. Verifica la cédula.';
            }

            $stmt->close();
        } else {
            $_SESSION['error_message'] = 'No se pudo preparar la búsqueda del cliente.';
        }

        header('Location: dashboard.php?status=error&message=' . urlencode($_SESSION['error_message'] ?? 'No se pudo registrar la agenda'));
        exit();
    }

    header('Location: dashboard.php?status=error&message=Todos los campos son obligatorios');
    exit();
}

header('Location: dashboard.php');
exit();
