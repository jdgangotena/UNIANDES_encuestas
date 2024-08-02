<?php
    class template{
 
        public function __construct() {
        }

        public function tablePartIni(){
            return   '<table class="table table-sm table-bordered m-0">
                        <thead>
                            <tr class="text-center colorTexto">
                                <th class="my_tamanio_n" >N°</th>
                                <th class="my_tamanio_temaobse" >Tema</th>
                                <th class="my_tamanio_temaobse" >Observación</th>
                            </tr>
                        </thead>
                        <tbody>';
        }

        public function tablePartFin(){
            return   '  </tbody>
                    </table>';
        }

        public function tableResponsiveIni(){
            return '<div class="table-responsive">';
        }
        
        public function tableResponsiveFin(){
            return '</div>';
        }

        public function colmd_12Ini(){
            return '<div class="col-md-12 box-s">';
        }

        public function colmd_12Fin(){
            return '</div>';
        }

        public function colmd_12Inid($id){
            return '<div class="col-md-12 box-s" id= "'.$id.'">';
        }

        public function colmd_12Find(){
            return '</div>';
        }

        public function colmd_6Ini(){
            return '<div class="col-md-6">';
        }

        public function colmd_6Fin(){
            return '</div>';
        }

        public function rowIni(){
            return '<div class="row">';
        }

        public function rowFin(){
            return '</div>';
        }

        public function tituloh3($nombre){
            return '<h4 class="colorTexto" >'.$nombre.'</h4>';
        }
    }
?>