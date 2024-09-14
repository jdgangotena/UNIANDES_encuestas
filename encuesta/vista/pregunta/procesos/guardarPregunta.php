<?php
$mensaje = "";
if (isset($_POST['preg']) && isset($_POST['alter']) && isset($_POST['encu']) 
    && isset($_POST['orde']) && isset($_POST['tipo'])
    && $_POST['preg'] != NULL && $_POST['alter'] != NULL && $_POST['encu'] != NULL 
    && $_POST['orde'] != NULL && $_POST['tipo'] 
    && $_POST['tipo'] != "0" && $_POST['encu'] != "0") {

    require('./../../../assets/conx/funciones.php');

    $conectar = new funciones();

    $pregunta = $conectar->sanitize($_POST['preg']);
    $alternativas = $_POST['alter'];
    $orden = $_POST['orde'];
    $encuesta = $_POST['encu'];
    $tipo_preg = $_POST['tipo'];
    
    $limite = sizeof($alternativas);

    $consulta = "INSERT INTO pregunta_ns(pregunta, id_tipo_preg) VALUES ('$pregunta', $tipo_preg);";
    $resultado = $conectar->ejecutarRReturn($consulta);
    $cod_auto = $conectar->codAutoGenerado();

    if ($resultado) {
        $mensaje = "OK";

        $hconsulta = "INSERT INTO preg_alternativa_ns(id_pregunta, alternativa, orden) VALUES ";
        $values = [];

        for ($i = 0; $i < $limite; $i++) {
            $alternativa_limpia = $conectar->sanitize($alternativas[$i]);
            $orden_limpio = intval($orden[$i]);

            echo "Alternativa $i: Tipo de pregunta es $tipo_preg<br>";
            echo "Alternativa original $i: " . $alternativas[$i] . "<br>";
            echo "Alternativa limpia $i: $alternativa_limpia<br>";
            echo "Orden limpio $i: $orden_limpio<br>";

            // Si el tipo de pregunta es 3, la alternativa debe estar vacía y el orden en 0
            if ($tipo_preg == 3) {
                $values[] = "($cod_auto, '', 0)";
            } else {
                // En otros casos, guarda la alternativa limpia y el orden
                if (!empty($alternativa_limpia)) {
                    $values[] = "($cod_auto, '$alternativa_limpia', $orden_limpio)";
                } else {
                    // Caso donde la alternativa está vacía pero no es tipo 3
                    echo "Advertencia: Se encontró una alternativa vacía o inválida para el índice $i.<br>";
                }
            }
        }

        if (!empty($values)) {
            $consulta = $hconsulta . implode(',', $values) . ";";
            echo "<strong>Consulta Generada:</strong> $consulta<br>"; // Mostrar la consulta generada para depuración

            $resultado = $conectar->ejecutarReturn($consulta);

            if (!$resultado) {
                echo "Error en la consulta: " . $conectar->getConexion()->error . "<br>";
                $mensaje = "Error en la consulta de alternativas.";
            } else {
                $mensaje = "OK2";

                $consulta = "INSERT INTO preg_encuesta_ns(id_pregunta, id_encuesta) VALUES ($cod_auto, $encuesta);";
                echo "<strong>Consulta Generada:</strong> $consulta<br>";

                $resultado = $conectar->ejecutarReturn($consulta);

                if ($resultado) {
                    $mensaje = "OK3";
                } else {
                    $mensaje = "NUL3";
                    echo "Error en la consulta: " . $conectar->getConexion()->error . "<br>";
                }
            }
        } else {
            $mensaje = "No se generaron valores válidos para la inserción.";
        }
    } else {
        $mensaje = "Error al insertar la pregunta.";
    }
} else {
    $mensaje = "No existen variables.";
}
echo $mensaje;
?>
