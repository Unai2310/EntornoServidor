<?php
// Controlador
require_once('app/Cliente.php');
require_once('app/AccesoDatos.php');
require_once('app/Acciones.php');
define ('FPAG',10); // Número de filas por página

session_start();

$midb = AccesoDatos::getModelo();
$totalfilas = $midb->numClientes();
if ( $totalfilas % FPAG == 0){
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = $totalfilas - $totalfilas % FPAG;
}

if ( !isset($_SESSION['posini']) ){
  $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];

// Proceso la ordenes
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ( isset($_GET['orden'])) {

        switch ( $_GET['orden']) {
            case "<<"       : $posAux = 0; $_SESSION['msg']=""; break;
            case ">"        : $posAux +=FPAG; $_SESSION['msg']=""; if ($posAux > $posfin) $posAux=$posfin; break;
            case "<"        : $posAux -=FPAG; $_SESSION['msg']=""; if ($posAux < 0) $posAux =0; break;
            case ">>"       : $posAux = $posfin; $_SESSION['msg']=""; break;
            case "Borrar"   : accionBorrar($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']);  break;
            case "Detalles" : accionDetalles($_GET['id']); break;
            case "Cliente Nuevo" : accionAlta(); break;
        }
    }
} else {
    if ( isset($_POST['orden'])) {
        switch ( $_POST['orden']) {
            case "Modificar" : accionPostModificar(); break;
            case "Crear" : accionPostAlta(); break;
        }
    }
}

$_SESSION['posini'] = $posAux;
// Accedo al Modelo
$tvalores = $midb->getClientes($posAux,FPAG);
// Invoco la vista
include_once('app/plantillas/principal.php');

