<?php
require('conexion.php');

class funciones extends conexion {
    public function __construct() {
        parent::__construct();
    }

    public function ejecutarSReturn($consulta, $params = []) {
        return $this->consulta($consulta, 0, $params);
    }

    public function ejecutarReturn($consulta, $params = []) {
        $resultado = $this->consulta($consulta, 0, $params);
        
        if ($resultado === false) {
            // Mostrar el error de MySQL si la consulta falla
            return "Error MySQL: " . $this->getConexion()->error;
        }
        
        return $resultado;
    }

    public function ejecutarRReturn($consulta, $params = []) {
        $resultado = $this->consulta($consulta, 1, $params);
        if ($resultado === false) {
            // Mostrar el error de MySQL si la consulta falla
            return "Error MySQL: " . $this->getConexion()->error;
        }
        return $resultado;
    }

    public function codAutoGenerado() {
        return $this->getCodigoAuto();
    }

    public function analizarSentimiento($respuestas) {
        $positivo = 0;
        $negativo = 0;

        foreach ($respuestas as $respuesta) {
            if (strpos($respuesta, 'bueno') !== false || strpos($respuesta, 'excelente') !== false) {
                $positivo++;
            } elseif (strpos($respuesta, 'malo') !== false || strpos($respuesta, 'deficiente') !== false) {
                $negativo++;
            }
        }

        return $negativo > $positivo ? 'Negativo' : ($positivo > $negativo ? 'Positivo' : 'Neutral');
    }

    public function generarRecomendacion($sentimiento) {
        switch ($sentimiento) {
            case 'Negativo':
                return 'Se recomienda mejorar la calidad del servicio y tiempos de atención.';
            case 'Neutral':
                return 'El servicio es aceptable, pero puede optimizarse en algunas áreas.';
            case 'Positivo':
            default:
                return 'Mantener el servicio con los mismos estándares de calidad.';
        }
    }

    public function sanitize($value) {
        return $this->getConexion()->real_escape_string($value);
    }
}
?>
