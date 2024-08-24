<?php
$mensaje = "";
if (isset($_POST['ce']) || isset($_POST['ra']) || isset($_POST['te'])) {

    require('../assets/conx/funciones.php');

    $conectar = new funciones();

    $myce = $_POST['ce'] ?? null;
    $myra = $_POST['ra'] ?? null;
    $myte = $_POST['te'] ?? null;

    $limce = is_array($myce) ? sizeof($myce) : 0;
    $limra = is_array($myra) ? sizeof($myra) : 0;
    $limte = is_array($myte) ? sizeof($myte) : 0;

    $consulta = "SELECT PE.id_preg_encuesta, PE.id_pregunta, PA.id_preg_alternativa, PR.id_tipo_preg
        FROM preg_encuesta_ns AS PE
        JOIN preg_alternativa_ns AS PA ON PE.id_pregunta = PA.id_pregunta
        JOIN pregunta_ns AS PR ON PA.id_pregunta = PR.id_pregunta
        WHERE PE.id_encuesta = 1 AND PR.estado = 1
        ORDER BY PE.id_pregunta ASC, PA.id_preg_alternativa ASC;";

    $myce_can = 0;
    $myra_can = 0;
    $myte_can = 0;

    $resultado = $conectar->ejecutarReturn($consulta);
    $myIndicadorE = "";

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = $resultado->fetch_array()) {
            if ($fila[1] != $myIndicadorE) {
                switch ($fila[3]) {
                    case 1:
                        $myce_can++;
                        break;
                    case 2:
                        $myra_can++;
                        break;
                    case 3:
                        $myte_can++;
                        break;
                }
                $myIndicadorE = $fila[1];
            }
        }
    } else {
        $mensaje = "No existe encuesta";
    }

    if (($limce >= $myce_can) && ($limra >= $myra_can) && ($limte >= $myte_can)) {
        $hconsulta = "INSERT INTO llenado_ns(id_encuesta, id_preg_alternativa, my_respuesta, my_id_token, recomendacion) VALUES";
        $bconsulta = "";

        $my_id_token = microtime(true);

        foreach ([$myce, $myra, $myte] as $respuestas) {
            if (is_array($respuestas)) {
                foreach ($respuestas as $respuesta) {
                    $mydatos = explode("|", $respuesta);
                    $myid = str_replace("respuesta_alter", "", $mydatos[0]);
                    $bconsulta .= "(1, '$myid', '{$mydatos[1]}', '$my_id_token', NULL),";
                }
            }
        }

        $consulta = substr($hconsulta . $bconsulta, 0, -1) . ";";

        // Ejecutar la consulta y manejar errores
        $resultado = $conectar->getConexion()->query($consulta);

        if ($resultado) {
            // Mostrar la alerta y redirigir
            echo "OK";
            exit(); // Detener la ejecución después de redirigir
        } else {
            // Mostrar el error exacto de MySQL
            echo "Error al guardar las respuestas: Error MySQL: " . $conectar->getConexion()->error;
        }
    } else {
        $mensaje = "Falta completar las preguntas.";
    }
} else {
    $mensaje = "No existen variables.";
}

echo $mensaje;
?>
