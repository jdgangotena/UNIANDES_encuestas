<!DOCTYPE html>
<html lang="es">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <head>
        <title>Encuesta S360</title>
        <?php 
            $ruta='./';
            require($ruta.'assets/include/links.php');
        ?>
        <link rel="stylesheet" href="./procesos/respuesta.css">
        <script src="./procesos/jPages.js"></script>
       
    </head>
    <body>
        <div id="my_tope">
            <div class="my_animacion">
	           <div>
	           </div>
            </div>
        </div>

        <div class="alturaClass">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12 centrar-custom my-img-content-p">
                            <img class="my-img-logo-per" src="./assets/img/logobS360.jpg" alt="S360">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-12 my-3 text-center">
                        </div>
                        <div class="col-sm-12 my-3">
                            <div class="holder text-uppercase text-center">
                            </div>
                        </div>
                        <div class="col-sm-12 pb-2">
                            <div id="myIdEncuesta">
                                <form id="myFormEncuesta" name="myFormEncuesta" onsubmit="return false" action="" autocomplete="off">
                                    <?php require("./procesos/visualizarEncuesta.php"); ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal OKI-->
        <div class="modal fade" id="miModalOKI" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1 bg-info my-modal-h-per">
                        <h5 class="modal-title text-white">Información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 p-0 text-center OKIcono"></div>
                                <div class="col-sm-9 p-0 text-center">
                                    <h5 id="OKIconcepto">--</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-1 border-0 align-self-center"></div>
                </div>
            </div>
        </div>
        <!-- Fin Modal OKI-->

        <script src="./procesos/respuesta.js"></script>
        <script>
        $(document).ready(function () {
            $(function () {
                $("div.holder").jPages({
                    containerID: "myFormEncuesta",
                    perPage: 1
                });
            });
        });
        </script>
    </body>
</html>