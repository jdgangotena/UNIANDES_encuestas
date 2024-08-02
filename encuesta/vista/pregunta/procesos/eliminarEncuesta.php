<?php
    $mensaje = "";
    if(isset($_POST['valor']) && $_POST['valor'] != NULL ){

        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $encuesta = $_POST['valor'];

        $id_encuesta = str_replace("my_eli_encu","", $encuesta);

        $consulta = "DELETE FROM encuesta_ns WHERE id_encuesta = $id_encuesta;";

        $resultado = $conectar->ejecutarReturn($consulta);

        if($resultado == true){
            $mensaje = "OK";
        }else{
            $mensaje = "NUL";
        }
    }else{
        $mensaje = "No existen variables";
    }
    echo $mensaje;
?>