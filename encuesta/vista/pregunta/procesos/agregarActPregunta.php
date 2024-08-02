<?php
    $mensaje = "";
    if(isset($_POST['valor']) && $_POST['valor'] != NULL ){

        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();

        $id_pregunta = $_POST['valor'];
        
       
        $consulta = "INSERT INTO preg_alternativa_ns(id_pregunta, alternativa) VALUES ('$id_pregunta', '');";

        $resultado = $conectar->ejecutarRReturn($consulta);
        $cod_auto = $conectar->codAutoGenerado();

        if($resultado == true){
            $mensaje = '<div class="col-sm-12 py-1"> 
            <div class="row my_cursor_eli">
                <div class="col-sm-10" >
                    <input type="text" class="form-control form-control-sm" id="up_alter'.$cod_auto.'" 
                        value="" onkeyup="preguardarAlter(this);" placeholder="Escribe una alternativa">
                </div>
                <div class="col-sm-2">
                    <a href="#" class="badge badge-danger" title="Eliminar alternativa"
                        onclick="modalDesicion(2,'.$cod_auto.');">
                        <i class="fa fa-close fa-sm px-1" ></i>
                    </a>
                </div>
            </div>
        </div>';
        }else{
            $mensaje = "NUL";
        }
    }else{
        $mensaje = "No existen variables";
    }
    echo $mensaje;
?>