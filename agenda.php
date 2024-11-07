<?php
include("connection.php");

// Simulación de datos, normalmente esto vendría de la base de datos
$cliente = [
    'nombre' => 'Juan Pérez',
    'categoria' => 'B',
    'fecha_inicio' => '2024-11-10',
    'fecha_fin' => '2024-11-20'
];

// Función para generar fechas entre inicio y fin
function generarFechas($inicio, $fin) {
    $fechas = [];
    $fecha_inicio = new DateTime($inicio);
    $fecha_fin = new DateTime($fin);
    $fecha_fin->modify('+1 day'); // Incluir el día final

    $intervalo = new DateInterval('P1D'); // Intervalo de 1 día

    $periodo = new DatePeriod($fecha_inicio, $intervalo, $fecha_fin);
    foreach ($periodo as $fecha) {
        $fechas[] = $fecha->format('Y-m-d');
    }

    return $fechas;
}

$fechas_curso = generarFechas($cliente['fecha_inicio'], $cliente['fecha_fin']);
?>
