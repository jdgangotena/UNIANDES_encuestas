<?php
class seguridad
{
    private $is_security = 0;

    //0 --> ACTIVADA
    //1 --> DESACTIVADA

    public function getSeguridad()
    {
        if($this->is_security == 0){
            session_start();
            if (!isset($_SESSION['key_token'])) // NO EXISTE
            {
                header("Location: ../ ");
            }

        }else{
            header("Location: ./ ");
        }
    }

    public function returnInitialPage(){
        //$myHost = $_SERVER["HTTP_HOST"];
        header("Location: /visitadorMedico/modulo/");
    }
}
?>