<?php
    $mensaje = "";
    if(isset($_POST['encu']) && $_POST['encu'] != NULL){
        require('./../../../assets/conx/funciones.php');
        include('./template.php');
        $conectar = new funciones();
        $miplantilla = new template();

        $encuesta = $_POST['encu'];
        
        $consulta = "SELECT PE.id_preg_encuesta, PE.id_pregunta, PA.id_preg_alternativa,
        PR.pregunta, PA.alternativa, PA.orden, PE.orden, PR.id_tipo_preg
        FROM preg_encuesta_ns AS PE
        JOIN preg_alternativa_ns AS PA
        ON PE.id_pregunta = PA.id_pregunta
        JOIN pregunta_ns AS PR 
        ON PA.id_pregunta = PR.id_pregunta
        WHERE PE.id_encuesta = $encuesta AND PR.estado = 1
        ORDER BY PE.id_pregunta ASC, PA.id_preg_alternativa ASC;";

        $resultado = $conectar->ejecutarReturn($consulta);
        
        $imprimir = "";
        $id_pregunta = 0;
        $escribir = "";
        $titulo = "";

        if(mysqli_num_rows($resultado)>0){
            while($fila=$resultado->fetch_array()){
                if($fila[1]  != $id_pregunta){
                    $escribir.= '<div class="col-sm-12 my_cursor_eli">
                                    <div class="row">
                                        <div class="col-sm-10 p-0">
                                            <h5 class="colorTexto" >'.$fila[3].'</h5>
                                        </div>
                                        <div class="col-sm-2 p-0 text-right">
                                            <a href="#" class="badge badge-warning" title="Editar pregunta"
                                                onclick="editarPregunta('.$fila[1].');">
                                                <i class="fa fa-pencil fa-sm px-1" ></i>
                                            </a>
                                            <a href="#" class="badge badge-danger" title="Eliminar pregunta"
                                                onclick="modalDesicion(1,'.$fila[1].');">
                                                <i class="fa fa-close fa-sm px-1" ></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
                    if($fila[7] == 3){
                        $escribir .= '<div class="form-group py-1">
                            <textarea class="form-control form-control-sm" id="text_tex_alter'.$fila[2].'" style="min-height: 90px; max-height: 90px;">'.$fila[4].'</textarea>
                        </div>';
                    }else if($fila[7] == 2){
                        $escribir.='<div class="form-check py-1">
                            <input type="radio" class="form-check-input my-puntero" name="text_rad_alter'.$fila[1].'" id="text_rad_alter'.$fila[2].'" value="'.$fila[2].'">
                            <label class="form-check-label my-puntero" for="text_rad_alter'.$fila[2].'">'.$fila[4].'</label>
                        </div>';
                    }else{
                        $escribir.= '<div class="form-check py-1">
                            <input type="checkbox" class="form-check-input my-puntero" id="text_che_alter'.$fila[2].'" value="'.$fila[2].'">
                            <label class="form-check-label my-puntero" for="text_che_alter'.$fila[2].'">'.$fila[4].'</label>
                        </div>';
                    }
                    $id_pregunta = $fila[1];
                }else{
                    if($fila[7] == 3){
                        $escribir .= '<div class="form-check py-1">
                            <textarea class="form-control form-control-sm" id="text_tex_alter'.$fila[2].'" style="min-height: 90px; max-height: 90px;">'.$fila[4].'</textarea>
                        </div>';

                    }else if($fila[7] == 2){
                        $escribir.='<div class="form-check py-1">
                            <input type="radio" class="form-check-input my-puntero" name="text_rad_alter'.$fila[1].'" id="text_radio_alter'.$fila[2].'" value="'.$fila[2].'">
                            <label class="form-check-label my-puntero" for="text_radio_alter'.$fila[2].'">'.$fila[4].'</label>
                        </div>';
                    }else{
                        $escribir.= '<div class="form-check py-1">
                            <input type="checkbox" class="form-check-input my-puntero" id="text_che_alter'.$fila[2].'" value="'.$fila[2].'">
                            <label class="form-check-label my-puntero" for="text_che_alter'.$fila[2].'">'.$fila[4].'</label>
                        </div>';
                    }
                }
            }
            $imprimir .= $miplantilla->colmd_12Ini();
            $imprimir .= $escribir;
            $imprimir .= $miplantilla->colmd_12Fin();
            $mensaje = $imprimir;
        }else{
            $mensaje = "Encuesta vacia";
        }
    }else{
        $mensaje = "No existen variables";
    }
    echo $mensaje;
?>