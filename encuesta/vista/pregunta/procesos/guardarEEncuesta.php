<?php
    $mensaje = "";
    if(isset($_POST['valor']) && $_POST['valor'] != null){

        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $encuesta = $_POST['valor'];

        $id_encuesta= str_replace("my_encu_activo","", $encuesta[0]);
        $estado = $encuesta[1];

        $consulta = "UPDATE encuesta_ns SET estado = $estado WHERE id_encuesta = $id_encuesta;";

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