<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SISTEMA DE ENCUESTA</title>
        <?php 
        session_start();
        $ruta = './';
        require($ruta.'assets/include/links.php');
        ?>
    </head>
    <body class="my-body-style">
        <div class="alturaClass centrar-custom" >
            <div class="col-lg-4 my-login py-3 bd-callout bd-callout-warning">
                <div class="col-lg-12 p-0">
                        <div class="col-sm-12 centrar-custom my-img-content-p">
                            <img class="my-img-logo-per" src="./assets/img/logobS360.jpg" alt="S360"
                                title="S360">
                        </div>
                </div>
                <div class="col-lg-12 p-0 ">
                    <h6 class="text-center my-titulo-texto py-3 border-linea">
                        SISTEMA DE ENCUESTA ONLINE
                    </h6>
                </div>
                <div class="col-lg-12 p-0">
                    <?php
                    if (!empty($_GET['v']) && !empty($_GET['t']))
                    {
                        if ($_GET['v']=='fallo') 
                        {
                            echo '<div class="alert alert-danger p-2 alert-dismissible fade show" role="alert">
                            Falta Ingresar <strong>Datos</strong>.
                          </div>';
                        }
                        elseif ($_GET['v']=='falloClave')
                        {
                            echo '<div class="alert alert-danger p-2 alert-dismissible fade show" role="alert">
                            Usuario o Contraseña <strong>Incorrecta</strong>.
                          </div>';
                        }
                    }
                    ?>
                    <form action="./logearse/index.php" method="post" autocomplete="off">
                        <div class="">
                            <input name="usuario" class="form-control form-control-sm my-2 " 
                                type="text" placeholder="Escribe tu usuario"
                                title="Escribe tu usuario">
                            <input name="clave" class="form-control form-control-sm my-2 " 
                                type="password" 
                                placeholder="Escribe tu contraseña"
                                title="Escribe tu contraseña">
                        </div>
                        <input type="submit"
                         class="btn btn-block btn-info text-white font-weight-bold mt-2" 
                         title="Ingresar"
                         value="INGRESAR">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>