<?php



function accionDetalles($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}


function accionModificar($columna) {
    $usuario = $_SESSION['tuser'][$columna];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Modificar";
    include_once "layout/formulario.php";
    exit();
}

function accionPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $nuevo = [ $_POST['nombre'],$_POST['login'],$_POST['clave'],$_POST['comentario']];
    $_SESSION['tuser'][]= $nuevo;
}

function accionPostModificar() {
    limpiarArrayEntrada($_POST);
    $modificado = [$_POST['nombre'],$_POST['login'],$_POST['clave'],$_POST['comentario']];
    foreach ($_SESSION['tuser'] as $clave => $valor) {
        if ($valor[1] == $modificado[1]) {
            $_SESSION['tuser'][$clave] = $modificado;
        }
    }
}


