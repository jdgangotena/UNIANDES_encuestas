<!DOCTYPE html>
<html lang="es">
<head>
    <title>GESTIÓN ENCUESTA</title>
        <?php
            include("./../login/seguridad.php");
            $security = new seguridad();
            $security->getSeguridad();
            $ruta='../../';
            require($ruta.'assets/include/links.php');
        ?>
    </title>
    <link rel="stylesheet" href="./procesos/pregunta.css">
</head>
<body>
    <div class="container-fluid p-0">
        <div class="col-lg-12 my-menu-per my-contenedor-sombra">
            <div class="row">
                    <div class="col-lg-6 text-rigth">
                        <div class="row">
                            <div class="col-lg-2 p-0 centrar-custom">
                                <img class="my-logo-per img-fluid" 
                                    src="<?php echo $ruta; ?>assets/img/logobS360.jpg" alt="S360"
                                    title="S360">
                            </div>
                            <div class="col-lg-6 p-0 text-left">
                                <ul class="my-lista-logo">
                                    <li class="text-uppercase">SUPERACIÓN 360</li>
                                    <li class="text-uppercase">SISTEMA DE ENCUESTA ONLINE</li>
                                    <li class="text-underline"></li>
                                    <li class="">Poner el área que gestiono el proyecto</li>
                                </ul>
                            </div>
                            <div class="col-lg-4 p-0 text-left">
                                <div class="my_menu_reporte text-center d-none">
                                    <span title="Reporte de encuesta">Reporte de Encuesta</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="row">
                            <div class="col-lg-10 p-0 my-nombre-usuario">
                                <ul class="my-lista-logo">
                                    <li class="text-warning">
                                        <?php echo strtoupper($_SESSION['usu_nombre']); ?>
                                    </li>
                                    <li class="myCronoTime" id="myCronoTime">
                                        <?php echo strtoupper($_SESSION['usu_usuario']); ?>
                                    </li>
                                    <li>
                                        <button type="button" class="my-btn-per" id="my-btn-menu-per" 
                                            onclick="abrirOpciones();">
                                            <i class="fa fa-th-list fa-sm px-1"></i>
                                            <div class="my-usuario-opcion bg-white" id="my-usuario-opcion" 
                                                style="display: none;">
                                                <div class="my-opciones p-1 text-left d-none">
                                                    <div class="form-check py-0">
                                                        <input type="checkbox" id="myBloqueo" class="form-check-input p-0" >
                                                        <label for="myBloqueo" class="form-check-label p-1 m-0" >Bloquear</label>    
                                                    </div>
                                                </div>
                                                <div class="my-opciones p-1 text-left">
                                                    <a title="Reporte de encuesta" href="#"
                                                        onclick="abrirModalReEncu();">
                                                        <i class="fa fa-file-excel-o fa-sm p-1"></i> 
                                                        Reporte de Encuesta
                                                    </a>
                                                </div>
                                                <div class="my-opciones p-1 text-left">
                                                    <a title="Cerrar sesión" 
                                                        href="../login/index.php">
                                                        <i class="fa fa-sign-out fa-sm p-1"></i> 
                                                        Cerrar sesión
                                                    </a>
                                                </div>
                                            </div>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-2 centrar-custom">
                                <img class="my-img-per img-fluid" 
                                    src="<?php echo $ruta; ?>assets/img/usuarioa.png" 
                                    alt="usuario" title="Usuario">
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-12 my-contenedor-hijo">
            <div class="row">
                <div class="col-lg-6 p-0">
                <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12 p-0">
                                <h5 class="text-left my-titulo-texto py-3">Registrar Preguntas</h5>
                            </div>

                            <div class="input-group input-group-sm py-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" title="Encuesta">Encuesta</span>
                                </div>
                                <select class="form-control form-control-sm" name="my_encuesta" id="my_encuesta"
                                    onchange="visualizarEncuesta();" title="Seleccione tipo encuesta" autocomplete="off">
                                    <option value="0" selected >[SELECCIONAR]</option>
                                </select>
                                <button type="button" id="btn-nuevo-te" class="btn btn-primary btn-sm mx-1" 
                                    onclick="nuevaEncuesta();" title="Nueva encuesta">
                                    <i class="fa fa-plus fa-sm px-1" ></i>
                                </button>
                            </div>

                            <div class="input-group input-group-sm py-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" title="Tipo pregunta">Tipo Pregunta</span>
                                </div>
                                <select class="form-control form-control-sm" name="my_tp_preg" id="my_tp_preg"
                                    onchange="habilitaPorTPregunta(this)" title="Seleccione tipo pregunta" autocomplete="off">
                                    <option value="0" selected >[SELECCIONAR]</option>
                                </select>
                            </div>

                            <div class="input-group input-group-sm py-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" title="Pregunta">Pregunta</span>
                                </div>
                                <input type="text" name="my_preg" id="my_preg" class="form-control" 
                                    placeholder="Escribe una pregunta" title="Escribe una pregunta" 
                                    autocomplete="off">
                                <button type="button" id="btn-nuevo-alt" class="btn btn-success btn-sm mx-1" 
                                    onclick="guardarPregunta();" title="Guardar pregunta">
                                    <i class="fa fa-save fa-lg px-1" ></i>
                                </button>
                            </div>
                            
                            <div class="col-lg-12 m-3" id="my_alternativas">
                                <div class="input-group input-group-sm py-1">
                                    <input type="text" name="my_alter0" id="my_alter0" class="form-control my-tam-alter" disabled
                                        placeholder="Escribe una alternativa" title="Escribe una alternativa" 
                                        autocomplete="off">
                                    <button type="button" id="btn_alt0" class="btn btn-warning btn-sm mx-1" disabled autocomplete="off"
                                        onclick="nuevaAlternativa('my_alter0', 'btn_alt0', 'my_div0', 'my_orden0');" title="Nueva alternativa">
                                        <i class="fa fa-plus fa-sm px-1" ></i>
                                    </button>
                                    <input type="text" name="my_orden0" id="my_orden0" class="form-control my-tam-order" disabled
                                        placeholder="Orden" title="Orden" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12 p-0">
                                <h5 class="text-left my-titulo-texto py-3">Vista Previa de Preguntas</h5>
                            </div>
                            <div class="col-lg-12" id="my_encuesta_view">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Reporte -->
    <div class="modal fade" id="miModalReEncu" tabindex="-1" role="dialog"aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-dark bg-warning">
                        <h5 class="modal-title my-text-white">Reporte de Encuesta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="input-group input-group-sm py-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" title="Encuesta">Encuesta</span>
                                </div>
                                <select class="form-control form-control-sm" 
                                    name="my_re_encuesta" id="my_re_encuesta"
                                    title="Seleccione tipo encuesta" autocomplete="off">
                                </select>
                                <button type="button" id="btn-re-encuesta" class="btn btn-success btn-sm mx-1" 
                                    onclick="reporteEncuExcel();" title="Reporte de encuesta">
                                    <i class="fa fa-file-excel-o fa-sm px-1" ></i>
                                </button>
                        </div>
                    </div>
                    <div class="text-left pr-3 pb-3 pl-3">
                        <button type="button" class="btn btn-danger btn-sm" id="cerrarModalReEncu" 
                            data-dismiss="modal" aria-label="Close">Salir</button> 
                    </div>
                </div>
        </div>
    </div>
    <!-- Fin Modal Reporte -->



    <!-- Modal Editar -->
    <div class="modal fade" id="miModalEditar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-dark bg-warning">
                        <h5 class="modal-title my-text-white">Editar Pregunta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow:hidden;">
                        <div class="my_pregunta_completa" id="my_pregunta_completa">
                            ---
                        </div>
                    </div>
                    <div class="text-right pr-3 pb-3">
                        <button type="button" class="btn btn-danger btn-sm" id="cerrarModalEditar" data-dismiss="modal" aria-label="Close">Salir</button> 
                    </div>
                </div>
        </div>
    </div>
    <!-- Fin Modal Editar -->

    <!-- Modal Desicion -->
    <div class="modal fade" id="miModalDesicion" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1 bg-info">
                        <h5 class="modal-title my-text-white">Alerta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4 pt-0 pb-0 pl-1 pr-0 centrar-custom">
                                        <i class="fa fa-exclamation text-warning" style="font-size:50px;" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-lg-8 p-0 centrar-custom">
                                        <h6 id="miModalDesTexto">--</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-1 border-0 align-self-center">
                        <button type="button" class="btn btn-success btn-sm" id="eventeame" style="width:65px;">Si</button>
                        <button type="button" class="btn btn-danger btn-sm" id="cerrarModalDesicion" data-dismiss="modal" aria-label="Close" style="width:65px;">No</button>
                    </div>
                </div>
            </div>
    </div>
    <!-- Fin Modal Desicion -->

    <!-- Modal Encuesta -->
    <div class="modal fade" id="miModalEncuesta" tabindex="-1" role="dialog"aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-dark bg-warning">
                        <h5 class="modal-title my-text-white">Encuesta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12 p-0">
                            <button type="button" class="btn btn-primary btn-sm my-1"
                                id="my_encu_nuevo" title="Nueva encuesta"
                                onclick="verNuevaEncuesta();">
                                <i class="fa fa-plus fa-sm px-1" ></i> Nuevo
                            </button>
                            <button type="button" class="btn btn-danger btn-sm my-1"
                                id="my_encu_cancelar" title="Cancelar encuesta"
                                onclick="verCancelarEncuesta();" disabled>
                                <i class="fa fa-close fa-sm px-1" ></i> Cancelar 
                            </button>
                        </div>
                        
                        <div class="col-lg-12 p-0" id="my-llenado-encuesta" style="display:none;">
                            <div class="input-group input-group-sm py-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" title="Encuesta">Encuesta</span>
                                </div>

                                <input type="text" name="my_n_encuesta" id="my_n_encuesta" class="form-control" 
                                    placeholder="Escribe una encusta" title="Escribe una encuesta" 
                                    autocomplete="off">

                                <button type="button" id="btn-guardar-en" class="btn btn-success btn-sm mx-1" 
                                    onclick="guardarNuevaEncuesta();" title="Guardar Encuesta">
                                    <i class="fa fa-save fa-sm px-1" ></i>Guardar
                                </button>

                            </div>
                        </div>
                    
                        <div class="table-responsive my_encuesta_completa" 
                            id="my_encuesta_completa">
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">N°</th>
                                        <th scope="col" class="d-none"></th>
                                        <th scope="col">Encuesta</th>
                                        <th scope="col" class="text-center">Estado</th>
                                        <th scope="col" class="text-center">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody class="my_encuesta_llenado" id="my_encuesta_llenado">
        
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-right pr-3 pb-3">
                        <button type="button" class="btn btn-danger btn-sm" id="cerrarModalEncuesta" data-dismiss="modal" aria-label="Close">Salir</button> 
                    </div>
                </div>
            </div>
    </div>
    <!-- Fin Modal Encuesta -->
    <script src="./procesos/pregunta.js"></script>
</body>
</html>