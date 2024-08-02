<?php
    $mensaje = "";
    if(isset($_POST['valor'])  && $_POST['valor'] != NULL ){
        
        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();
        
        $consulta = "SELECT id_encuesta, encuesta FROM encuesta_ns;";

        $resultado = $conectar->ejecutarReturn($consulta);

        $escribir = "<option value='0' selected >[SELECCIONAR]</option>";
        if(mysqli_num_rows($resultado)>0){
            while($fila=$resultado->fetch_array()){
                $escribir.= '<option value="'.$fila[0].'">'.$fila[1].'</option>';
            }
            $mensaje = $escribir;
        }else{
            $mensaje = "Pregunta vacia";
        }

    }else{
        $mensaje = "No existen variables";
    }
    echo $mensaje;
?>