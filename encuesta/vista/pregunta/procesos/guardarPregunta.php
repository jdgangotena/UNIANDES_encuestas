<?php
    $mensaje = "";
    if(isset($_POST['preg']) && isset($_POST['alter']) && isset($_POST['encu']) 
            && isset($_POST['orde']) && isset($_POST['tipo'])
            && $_POST['preg'] != NULL && $_POST['alter'] != NULL && $_POST['encu'] != NULL 
            && $_POST['orde'] != NULL && $_POST['tipo'] 
            && $_POST['tipo'] != "0" && $_POST['encu'] != "0"){

        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $pregunta = $_POST['preg'];
        $alternativa = $_POST['alter']; //FOR {POR CADA ALTERNATIVA INSERT}
        $orden = $_POST['orde']; //FOR {POR CADA ALTERNATIVA INSERT}
        $encuesta = $_POST['encu'];
        $tipo_preg = $_POST['tipo'];
        
        $limite = sizeof($alternativa);

        $consulta = "INSERT INTO pregunta_ns(pregunta, id_tipo_preg) VALUES ('$pregunta', $tipo_preg);";

        $resultado = $conectar->ejecutarRReturn($consulta);
        $cod_auto = $conectar->codAutoGenerado();

        if($resultado == true){
            $mensaje = "OK";
            $consulta = "";
            $resultado = null;
            
            $hconsulta = "INSERT INTO preg_alternativa_ns(id_pregunta, orden, alternativa) VALUES";
            $bconsulta = "";
            for($i = 0; $i < $limite; $i++){
                if($tipo_preg == 3){ 
                    $bconsulta.= "($cod_auto,  0, '$alternativa[$i]'),"; 
                }else{
                    $bconsulta.= "($cod_auto,  $orden[$i], '$alternativa[$i]'),";
                }
            }

            $consulta = substr($hconsulta.$bconsulta, 0, -1).";";
            $resultado = $conectar->ejecutarReturn($consulta);
            
            if($resultado == true){
                $mensaje = "OK2";

                $consulta = "";
                $resultado = null;

                $consulta = "INSERT INTO preg_encuesta_ns(id_pregunta, id_encuesta) VALUES($cod_auto, $encuesta);";

                $resultado = $conectar->ejecutarReturn($consulta);

                if($resultado == true){
                    $mensaje = "OK3";
                }else{
                    $mensaje = "NUL3";
                }
            }else{
                $mensaje = "NUL2";
            }
        }else{
            $mensaje = "NUL";
        }
    }else{
        $mensaje = "No existen variables";
    }
    echo $mensaje;
?>