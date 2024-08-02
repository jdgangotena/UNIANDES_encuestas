<?php
    $mensaje = "";
    if(isset($_POST['ce']) 
        || isset($_POST['ra']) 
        || isset($_POST['te']) ){

        require('../assets/conx/funciones.php');

        $conectar = new funciones();
        
        $myce = null;
        $myra = null;
        $myte = null;

        if(isset($_POST['ra'])){
            $myra = $_POST['ra'];
        }

        if(isset($_POST['ce'])){
            $myce = $_POST['ce'];
        }

        if(isset($_POST['te'])){
            $myte = $_POST['te'];
        }

        $limce = 0;
        $limra = 0;
        $limte = 0;
        if(is_array($myce)){
            $limce= sizeof($myce);
        }
        if(is_array($myra)){
            $limra= sizeof($myra);
        }
        if(is_array($myte)){
            $limte= sizeof($myte);
        }

        $consulta = "SELECT PE.id_preg_encuesta, PE.id_pregunta, PA.id_preg_alternativa, PR.id_tipo_preg
        FROM preg_encuesta_ns AS PE
        JOIN preg_alternativa_ns AS PA
        ON PE.id_pregunta = PA.id_pregunta
        JOIN pregunta_ns AS PR 
        ON PA.id_pregunta = PR.id_pregunta
        WHERE PE.id_encuesta = 1 AND PR.estado = 1
        ORDER BY PE.id_pregunta ASC, PA.id_preg_alternativa ASC;";

        $myce_can = 0;
        $myra_can = 0;
        $myte_can = 0;

        $resultado = $conectar->ejecutarReturn($consulta);
        $myIndicadorE  = "";
        if(mysqli_num_rows($resultado)>0){
            while($fila=$resultado->fetch_array()){

                if($fila[1] != $myIndicadorE){
                    if($fila[3] == 1){
                        $myce_can = $myce_can +1;
                    }else if($fila[3] == 2){
                        $myra_can = $myra_can +1;
                    }else if($fila[3] == 3){
                        $myte_can = $myte_can +1;
                    }else{}
                    $myIndicadorE = $fila[1];
                }
            }
        }else{
            $mensaje = "No existe encuesta";
        }

        if(($limce >= $myce_can) && 
            ($limra >= $myra_can) &&
            ($limte >= $myte_can)){
            
            $consulta = "";
            $resultado = null;


            $hconsulta = "INSERT INTO llenado_ns(id_encuesta, id_preg_alternativa, my_respuesta, my_id_token) VALUES";
            $bconsulta = "";

            $my_id_token = microtime(TRUE);
            
            if ($limce > 0){
                $mydatos = null;
                $myid = "";
                for($i = 0; $i < $limce; $i++){
                    $mydatos = explode("|", $myce[$i]);
                    $myid = str_replace("respuesta_alter","", $mydatos[0]);;
                    $bconsulta.= "(1,'$myid', '$mydatos[1]', '$my_id_token'),"; 
            
                }
            }
            
            if ($limra > 0){
                $mydatos = null;
                $myid = "";
                for($i = 0; $i < $limra; $i++){
                    $mydatos = explode("|", $myra[$i]);
                    $myid = str_replace("respuesta_alter","", $mydatos[0]);;
                    $bconsulta.= "(1,'$myid', '$mydatos[1]', '$my_id_token'),"; 
            
                }
            }

            if ($limte > 0){
                $mydatos = null;
                $myid = "";
                for($i = 0; $i < $limte; $i++){
                    $mydatos = explode("|", $myte[$i]);
                    $myid = str_replace("respuesta_alter","", $mydatos[0]);;
                    $bconsulta.= "(1,'$myid', '$mydatos[1]', '$my_id_token'),"; 
            
                }
            }

            $consulta = substr($hconsulta.$bconsulta, 0, -1).";";
            $resultado = $conectar->ejecutarReturn($consulta);
            
            if($resultado == true){
                $mensaje = "OK";
            }else{
                $mensaje = "NUL";
            }
            
        }else{
            $mensaje = "Falta completar las preguntas.";
            //$mensaje = $consulta;
            //$mensaje .= $limce."-".$limra."-".$limte."|Indi:";
            //$mensaje .= $myce_can."-".$myra_can."-".$myte_can;
        }
    }else{
        $mensaje = "No existen variables.";
    }
    echo $mensaje;
?>