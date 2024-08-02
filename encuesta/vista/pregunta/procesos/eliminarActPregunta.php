<?php
    $mensaje = "";
    if(isset($_POST['valor']) && $_POST['valor'] != NULL ){

        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $id_pregunta = $_POST['valor'];
        
        $consulta = "UPDATE pregunta_ns SET estado = 0 WHERE id_pregunta = $id_pregunta;";

        $resultado = $conectar->ejecutarReturn($consulta);

        if($resultado == true){
            $mensaje = 'OK';
        }else{
            $mensaje = "NUL";
        }
    }else{
        $mensaje = "No existen variables";
    }
    echo $mensaje;
?>