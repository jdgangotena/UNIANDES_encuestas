<?php
    $mensaje = "";
    if(isset($_POST['valor'])  && $_POST['valor'] != NULL ){
        
        require('./../../../assets/conx/funciones.php');

        $conectar = new funciones();
        
        $consulta = "SELECT id_encuesta, encuesta, estado FROM encuesta_ns;";

        $resultado = $conectar->ejecutarReturn($consulta);

        $escribir = "";
        if(mysqli_num_rows($resultado)>0){
            $cont = 1;
            while($fila=$resultado->fetch_array()){
                $escribir.= '<tr>
                                <th class="text-center">'.$cont.'</th>
                                <td class="d-none">'.$fila[0].'</td>
                                <td>'.$fila[1].'</td>
                                <td class="text-center">
                                <input type="checkbox" class="my-puntero" 
                                    id="my_encu_activo'.$fila[0].'" 
                                    name="my_encu_activo"
                                    value="'.$fila[2].'" 
                                    '.(($fila[2] == 1) ? "checked" : "").'
                                    onchange="preguarEEncuesta(this);">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        id="my_eli_encu'.$fila[0].'"
                                        onclick="modalDesicion(3,0,this);">
                                        <i class="fa fa-close fa-sm"></i>
                                    </button>
                                </td>
                            </tr>';
                $cont += 1;
            }
            $mensaje = $escribir;
        }else{
            $mensaje = '<tr>
                            <th class="text-center">--</th>
                            <td class="d-none">--</td>
                            <td>--</td>
                            <td class="text-center">--</td>
                            <td class="text-center">--</td>
                        </tr>';
        }

    }else{
        $mensaje = "No existen variables";
    }
    echo $mensaje;
?>