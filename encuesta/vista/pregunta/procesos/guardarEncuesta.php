<?php
    $mensaje = "";
    if(isset($_POST['valor']) && $_POST['valor'] != null){

        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $encuesta = $_POST['valor'];

        $consulta = "INSERT INTO encuesta_ns(encuesta) VALUES ('$encuesta');";

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