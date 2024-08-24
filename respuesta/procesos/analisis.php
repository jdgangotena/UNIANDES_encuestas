<?php
// Función para analizar el sentimiento de las respuestas
function analizarSentimiento($respuestas) {
    $positivo = 0;
    $negativo = 0;

    foreach ($respuestas as $respuesta) {
        // Este es un análisis básico basado en palabras clave
        if (strpos($respuesta, 'bueno') !== false || strpos($respuesta, 'excelente') !== false) {
            $positivo++;
        } elseif (strpos($respuesta, 'malo') !== false || strpos($respuesta, 'deficiente') !== false) {
            $negativo++;
        }
    }

    // Determinar el sentimiento predominante
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
?>
