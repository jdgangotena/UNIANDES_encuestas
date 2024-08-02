<?php
session_start();
try{
    $usuario = NULL;
    $clave = NULL;
    if(isset($_POST['usuario']) && isset($_POST['clave'])){
        if(!empty($_POST['usuario']) && !empty($_POST['clave'])){
            require('../assets/conx/funciones.php');
            $a=md5(uniqid(mt_rand(), true));
            $b=(microtime(TRUE));
            $r=$a."-".$b;

            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];

            $conectar = new funciones();

            $consulta = " SELECT CONCAT(apellidos, ', ', nombres) as 'p1', usuario FROM usuario_ns WHERE usuario = '".$usuario."' AND clave= '".$clave."' LIMIT 1;";

            $resultado = $conectar->ejecutarReturn($consulta);
            $fila = $resultado->fetch_array();
            if($fila != NULL){
                $_SESSION['usu_nombre'] = $fila[0];
                $_SESSION['usu_usuario'] = $fila[1];
                $_SESSION['key_token'] = $r;
                header('Location: ../vista/pregunta/');

            }else{
                $_SESSION['fallo']="falloClave";
                header("Location: ../?v=falloClave&t=".$r);
            }
        }else{
            $_SESSION['fallo']="falloClave";
            header("Location: ../?v=falloClave&t=".$r);
        }
    }else{
        $_SESSION['fallo']="fallo";
        header("Location: ../?v=fallo&t=".$r);
    }
}catch (Exception $e){
    $_SESSION['fallo']="fallo";
    header("Location: ../?v=fallo&t=".$r);
}
?>