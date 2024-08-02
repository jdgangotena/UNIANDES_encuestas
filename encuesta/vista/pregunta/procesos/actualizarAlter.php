<?php
    $mensaje = "";
    if(isset($_POST['valor']) && $_POST['valor'] != NULL){
        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $datos = $_POST['valor'];
        $id_alter = str_replace("up_alter","", $datos[0]);

        $consulta = "UPDATE preg_alternativa_ns SET alternativa = '$datos[1]' WHERE id_preg_alternativa = $id_alter;";

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