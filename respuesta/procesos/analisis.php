<?php
// Conexión a la base de datos
$mysqli = new mysqli('localhost', 'usuario', 'contraseña', 'mdmq_encuesta');
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Consulta para obtener las respuestas
$query = "SELECT my_respuesta FROM llenado_ns";
$result = $mysqli->query($query);

$respuestas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $respuestas[] = $row['my_respuesta'];
    }
}

// Función para analizar el sentimiento de las respuestas
function analizarSentimiento($respuestas) {
    $positivas = ['bueno', 'excelente', 'genial', 'satisfactorio', 'positivo', 'agradable'];
    $negativas = ['malo', 'deficiente', 'terrible', 'insatisfactorio', 'negativo', 'horrible'];

    $positivo = 0;
    $negativo = 0;

    foreach ($respuestas as $respuesta) {
        $respuesta = strtolower($respuesta); // Convertir a minúsculas para una comparación insensible a mayúsculas
        foreach ($positivas as $palabraPositiva) {
            if (strpos($respuesta, $palabraPositiva) !== false) {
                $positivo++;
            }
        }
        foreach ($negativas as $palabraNegativa) {
            if (strpos($respuesta, $palabraNegativa) !== false) {
                $negativo++;
            }
        }
    }

    if ($negativo > $positivo) {
        return 'Negativo';
    } elseif ($positivo > $negativo) {
        return 'Positivo';
    } else {
        return 'Neutral';
    }
}

// Función para generar recomendaciones basadas en el sentimiento
function generarRecomendacion($sentimiento) {
    if ($sentimiento == 'Negativo') {
        return 'Se recomienda mejorar la calidad del servicio y tiempos de atención.';
    } elseif ($sentimiento == 'Neutral') {
        return 'El servicio es aceptable, pero puede optimizarse en algunas áreas.';
    } else {
        return 'Mantener el servicio con los mismos estándares de calidad.';
    }
}

// Analizar el sentimiento de las respuestas
$sentimiento = analizarSentimiento($respuestas);

// Generar la recomendación
$recomendacion = generarRecomendacion($sentimiento);

// Preparar los datos para el CSV
$csvData = [];
$csvData[] = ['Respuesta', 'Sentimiento', 'Recomendación']; // Encabezados del CSV

foreach ($respuestas as $respuesta) {
    $csvData[] = [$respuesta, $sentimiento, $recomendacion];
}

// Generar y descargar el archivo CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="respuestas_con_recomendaciones.csv"');

$output = fopen('php://output', 'w');

// Escribir los datos en el archivo CSV
foreach ($csvData as $line) {
    fputcsv($output, $line);
}

fclose($output);
exit();
?>
