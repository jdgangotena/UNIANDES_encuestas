<?php
    $mensaje = "";

    if(isset($_POST['valor']) && $_POST['valor'] != NULL){
        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $datos = $_POST['valor'];
        $id_preg = str_replace("up_preg","", $datos[0]);

        $consulta = "UPDATE pregunta_ns SET pregunta = '$datos[1]' WHERE id_pregunta = $id_preg;";

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