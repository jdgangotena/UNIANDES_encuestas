<?php
    $mensaje = "";

        require('./assets/conx/funciones.php');
        include('./procesos/template.php');
        $conectar = new funciones();
        $miplantilla = new template();

        $consulta = "SELECT PE.id_preg_encuesta, PE.id_pregunta, PA.id_preg_alternativa,
        PR.pregunta, PA.alternativa, PA.orden, PE.orden, PR.id_tipo_preg
        FROM preg_encuesta_ns AS PE
        JOIN preg_alternativa_ns AS PA
        ON PE.id_pregunta = PA.id_pregunta
        JOIN pregunta_ns AS PR 
        ON PA.id_pregunta = PR.id_pregunta
        WHERE PE.id_encuesta = (SELECT ENCU.id_encuesta FROM encuesta_ns AS ENCU WHERE ENCU.estado = 1 LIMIT 1) 
        AND PR.estado = 1
        ORDER BY PE.id_pregunta ASC, PA.id_preg_alternativa ASC;";

        $resultado = $conectar->ejecutarReturn($consulta);
    
        $id_pregunta = 0;
        $escribir = "";
        $titulo = "";
        $indicador = 0;

        if(mysqli_num_rows($resultado)>0){

            while($fila=$resultado->fetch_array()){
                if($fila[1]  != $id_pregunta){

                    if($indicador == 1){
                        $escribir.='</div>';
                        $indicador = 0;
                    }

                    $escribir.='<div class="container icolec-encuesta" id="my-encuesta-container'.$fila[0].'">';
        
                    $indicador = 1;

                    $escribir.= '<h5 class="colorTexto" >'.$fila[3].'</h5>';
                    if($fila[7] == 3){
                        $escribir .= '<div class="form-group py-1 ismytexto">
                            <textarea class="form-control form-control-sm" id="respuesta_alter'.$fila[2].'" style="min-height: 90px; max-height: 90px;">'.$fila[4].'</textarea>
                        </div>';
                    }else if($fila[7] == 2){
                        $escribir.='<div class="form-check py-1 ismyradio">
                            <input type="radio" class="form-check-input my-puntero" id="respuesta_alter'.$fila[2].'" 
                                name="text_rad_alter'.$fila[1].'"  value="'.$fila[2].'">
                            <label class="form-check-label my-puntero" for="respuesta_alter'.$fila[2].'">'.$fila[4].'</label>
                        </div>';
                    }else{
                        $escribir.= '<div class="form-check py-1 ismycheck">
                            <input type="checkbox" class="form-check-input my-puntero" id="respuesta_alter'.$fila[2].'" 
                            name="text_che_alter'.$fila[1].'" value="'.$fila[2].'" onclick="noDesclickCheck(\'my-encuesta-container'.$fila[0].'\');">
                            <label class="form-check-label my-puntero" for="respuesta_alter'.$fila[2].'">'.$fila[4].'</label>
                        </div>';
                    }
                    $id_pregunta = $fila[1];
                }else{

                    if($fila[7] == 3){
                        $escribir .= '<div class="form-check py-1 ismytexto">
                            <textarea class="form-control form-control-sm" id="respuesta_alter'.$fila[2].'" 
                                style="min-height: 90px; max-height: 90px;">'.$fila[4].'</textarea>
                        </div>';

                    }else if($fila[7] == 2){
                        $escribir.='<div class="form-check py-1 ismyradio">
                            <input type="radio" class="form-check-input my-puntero" id="respuesta_alter'.$fila[2].'" 
                                name="text_rad_alter'.$fila[1].'"  value="'.$fila[2].'">
                            <label class="form-check-label my-puntero" for="respuesta_alter'.$fila[2].'">'.$fila[4].'</label>
                        </div>';
                    }else{
                        $escribir.= '<div class="form-check py-1 ismycheck">
                            <input type="checkbox" class="form-check-input my-puntero" id="respuesta_alter'.$fila[2].'" 
                                name="text_che_alter'.$fila[1].'" value="'.$fila[2].'" onclick="noDesclickCheck(\'my-encuesta-container'.$fila[0].'\');">
                            <label class="form-check-label my-puntero" for="respuesta_alter'.$fila[2].'">'.$fila[4].'</label>
                        </div>';
                    }

                }
            }
            $escribir.='</div>';
            $escribir.= '<div class="container icolec-encuesta"">
                            <div class="form-check py-1 text-center">
                                    <button type="submit" class="btn btn-success" onclick="enviarEncuesta();">
                                        Enviar Respuesta Encuesta
                                    </button>
                            </div>
                        </div>';
            $mensaje = $escribir;

        }else{
            $mensaje = "Encuesta vacia";
        }
    echo $mensaje;
?>