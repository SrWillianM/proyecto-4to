<?php
include("connection.php");

if (isset($_GET['ci'])) {
    $ci = $_GET['ci'];

    $query = "DELETE FROM cliente WHERE ci = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $ci);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?status=success&message=Cliente eliminado");
    } else {
        header("Location: ../dashboard.php?status=error&message=Error al eliminar cliente");
    }
}
?>
