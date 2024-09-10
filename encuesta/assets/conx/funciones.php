<?php
require('conexion.php');
class funciones extends conexion {
    #Listo el seleccionar generico:
    public function __construct() { }

    #No retorna la consulta ejecutada
    public function ejecutarSReturn($consulta){
        $resultado = $this->consulta($consulta, 0);
    }
    
    #Retorna consulta ejecutada
    public function ejecutarReturn($consulta){
        $resultado = $this->consulta($consulta, 0);
        return $resultado;
    }

    public function ejecutarRReturn($consulta){
        $resultado = $this->consulta($consulta, 1);
        return $resultado;
    }
    
    public function codAutoGenerado(){
        $resultado = $this->getCodigoAuto();
        return $resultado;
    }

    # Nuevo método sanitize
    public function sanitize($input) {
        return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }
}
?>
