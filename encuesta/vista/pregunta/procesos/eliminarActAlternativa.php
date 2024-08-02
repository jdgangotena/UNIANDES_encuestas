<?php
    $mensaje = "";
    if(isset($_POST['valor']) && $_POST['valor'] != NULL ){

        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $id_alternativa = $_POST['valor'];
        
        $consulta = "DELETE FROM preg_alternativa_ns WHERE id_preg_alternativa = $id_alternativa;";

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