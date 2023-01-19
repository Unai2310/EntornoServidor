<?php
session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';

if (isset($_SESSION['login'])) {
    $horaactual = time();
    if (intval($_SESSION['login']) > $horaactual) {
        session_destroy();
        include_once "app/layout/accesso.php";
    }
}

// Div con contenido
$contenido="";
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"    : accionAlta(); break;
            case "Borrar"   : accionBorrar   ($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']); break;
            case "Detalles" : accionDetalles ($_GET['id']);break;
            case "Terminar" : accionTerminar(); break;
            case "Saldo":
                if (isset($_GET['chk'])) {
                    accionAumentar($_GET["chk"]); 
                } break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (isset($_POST['orden'])) {
        switch ($_POST['orden']) {
            case "Nuevo": accionPostAlta(); break;
            case "Modificar": accionPostModificar(); break;
            case "Detalles": ; // No hago nada
        }
        accionAccesso($_POST['orden']);
    }
}

if (!isset($_SESSION['login'])){
    $contenido = mostrarDatos();
    include_once "app/layout/principal.php";
}



