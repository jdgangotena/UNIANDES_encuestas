<?php
    $mensaje = "";
    if(isset($_POST['encu']) && isset($_POST['preg']) 
        && $_POST['encu'] != NULL  && $_POST['preg'] != NULL){
        
        require('./../../../assets/conx/funciones.php');
        include('./template.php');
        $conectar = new funciones();
        $miplantilla = new template();
        
        $encuesta = $_POST['encu'];
        $pregunta = $_POST['preg'];

        $consulta = "SELECT PE.id_preg_encuesta, PE.id_pregunta, PA.id_preg_alternativa,
        PR.pregunta, PA.alternativa, PA.orden, PE.orden
        FROM preg_encuesta_ns AS PE
        JOIN preg_alternativa_ns AS PA
        ON PE.id_pregunta = PA.id_pregunta
        JOIN pregunta_ns AS PR 
        ON PA.id_pregunta = PR.id_pregunta
        WHERE PE.id_encuesta = $encuesta AND PE.id_pregunta = $pregunta;";

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
                                            <input type="text" class="form-control form-control-sm colorTexto" id="up_preg'.$fila[1].'" 
                                                value="'.$fila[3].'" onkeyup="preguardarPregunta(this);" placeholder="Escribe una pregunta">
                                        </div>
                                        <div class="col-sm-2 p-0 text-right">
                                            <a href="#" class="badge badge-primary" title="Agregar alternativa"
                                                onclick="agregarUpAlter('.$fila[1].');">
                                                <i class="fa fa-plus fa-sm px-1" ></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
                                
                    $escribir.= '<div class="col-sm-12 py-1 div-up-eli-'.$fila[2].'"> 
                                    <div class="row my_cursor_eli">
                                        <div class="col-sm-10" >
                                            <input type="text" class="form-control form-control-sm" id="up_alter'.$fila[2].'" 
                                                value="'.$fila[4].'" onkeyup="preguardarAlter(this);" placeholder="Escribe una alternativa">
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="#" class="badge badge-danger" title="Eliminar alternativa"
                                                onclick="modalDesicion(2,'.$fila[2].', this);">
                                                <i class="fa fa-close fa-sm px-1" ></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';

                    $id_pregunta = $fila[1];
                }else{
                    $escribir.= '<div class="col-sm-12 py-1 div-up-eli-'.$fila[2].'"> 
                                    <div class="row my_cursor_eli">
                                        <div class="col-sm-10" >
                                            <input type="text" class="form-control form-control-sm" id="up_alter'.$fila[2].'" 
                                                value="'.$fila[4].'" onkeyup="preguardarAlter(this);" placeholder="Escribe una alternativa">
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="#" class="badge badge-danger" title="Eliminar alternativa"
                                                onclick="modalDesicion(2,'.$fila[2].', this);">
                                                <i class="fa fa-close fa-sm px-1" ></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
                }
            }
            $imprimir .= $miplantilla->colmd_12Inid("my_edit_preg_completa");
            $imprimir .= $escribir;
            $imprimir .= $miplantilla->colmd_12Find();
            $mensaje = $imprimir;
        }else{
            $mensaje = "Pregunta vacia";
        }

    }else{
        $mensaje = "No existen variables";
    }
    echo $mensaje;
?>