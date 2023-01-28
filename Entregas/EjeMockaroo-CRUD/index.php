<?php
session_start();
define ('FPAG',10); // Número de filas por página


require_once 'app/helpers/util.php';
require_once 'app/config/configDB.php';
require_once 'app/models/Cliente.php';
require_once 'app/models/User.php';
require_once 'app/models/AccesoDatos.php';
require_once 'app/controllers/crudclientes.php';


//---- PAGINACIÓN ----
$midb = AccesoDatos::getModelo();
$totalfilas = $midb->numClientes();
$_SESSION['tfilas'] = $totalfilas;
if ( $totalfilas % FPAG == 0){
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = $totalfilas - $totalfilas % FPAG;
}

if ( !isset($_SESSION['posini']) ){
  $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];

$totalfilasU = $midb->numUsuarios();
$_SESSION['tfilasU'] = $totalfilasU;
if ( $totalfilasU % FPAG == 0){
    $posfinU = $totalfilasU - FPAG;
} else {
    $posfinU = $totalfilasU - $totalfilasU % FPAG;
}

if ( !isset($_SESSION['posiniU']) ){
  $_SESSION['posiniU'] = 0;
}
$posAuxU = $_SESSION['posini'];
//------------



ob_start(); // La salida se guarda en el bufer
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    // Proceso las ordenes de navegación
    if ( isset($_GET['nav'])) {
        switch ( $_GET['nav']) {
            case "Primero"  : $posAux = 0; break;
            case "Siguiente": $posAux +=FPAG; if ($posAux > $posfin) $posAux=$posfin; break;
            case "Anterior" : $posAux -=FPAG; if ($posAux < 0) $posAux =0; break;
            case "Ultimo"   : $posAux = $posfin;
        }
        $_SESSION['posini'] = $posAux;
    }

    if ( isset($_GET['navU'])) {
        switch ( $_GET['navU']) {
            case "Primero"  : $posAuxU = 0; break;
            case "Siguiente": $posAuxU +=FPAG; if ($posAuxU > $posfinU) $posAuxU=$posfinU; break;
            case "Anterior" : $posAuxU -=FPAG; if ($posAuxU < 0) $posAuxU =0; break;
            case "Ultimo"   : $posAuxU = $posfinU;
        }
        $_SESSION['posiniU'] = $posAuxU;
    }


     // Proceso las ordenes de navegación en detalles
    if ( isset($_GET['nav-detalles']) && isset($_GET['id'])) {
        switch ( $_GET['nav-detalles']) {
            case "Siguiente": 
            if (!isset($_SESSION['clave'])) {
                $_SESSION['clave'] = "id";
            }
            crudDetallesSiguiente($_GET[$_SESSION['clave']],$_SESSION['clave']); break;

            case "Anterior" : 
            if (!isset($_SESSION['clave'])) {
                $_SESSION['clave'] = "id";
            }
            crudDetallesAnterior($_GET[$_SESSION['clave']],$_SESSION['clave']); break;
            
            case "Imprimir" : crudImprimir($_GET); break;  
        }
    }

    // Proceso de ordenes de CRUD clientes
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"     : crudAlta(); break;
            case "Borrar"    : crudBorrar   ($_GET['id']); break;
            case "Modificar" : crudModificar($_GET['id']); break;
            case "Detalles"  : crudDetalles ($_GET['id']);break;
            case "Terminar"  : crudTerminar(); break;
            case "Roles"     : crudRoles(); break;
            case "VolverU"   : crudVolverU(); break;
            case "Cambiar"   : if (isset($_GET['chk'])) { crudPostCambiar($_GET["chk"]); } break;
            case "Ordenar"   : crudOrdenar($_GET['clave']); break;
            case "Registrar" : crudRegistro(); break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
        switch($_POST['orden']) {
            case "Nuevo"    : crudPostAlta(); break;
            case "Modificar": crudPostModificar(); break;
            case "Registrar": crudPostRegistro(); break;
            case "Volver"   : crudVolver(); break;
            case "Ingresar" : $_SESSION['posini'] = 0; crudIngreso($_POST['login'], $_POST['pass']); break;
            case "Detalles" :; // No hago nada
        }
    }

    if ( isset($_POST['nav-detalles']) && isset($_GET['id'])) {
        switch ( $_POST['nav-detalles']) {
            case "SiguienteM": 
            if (!isset($_SESSION['clave'])) {
                $_SESSION['clave'] = "id";
            }
            crudModificarSiguiente($_POST[$_SESSION['clave']],$_SESSION['clave']); break;
            case "AnteriorM" : 
            if (!isset($_SESSION['clave'])) {
                $_SESSION['clave'] = "id";
            }crudModificarAnterior($_POST[$_SESSION['clave']],$_SESSION['clave']); break;        
        }
    }
}

// Si no hay nada en la buffer 
// Cargo genero la vista con la lista por defecto
if (isset($_SESSION["login"]) && !isset($_SESSION["roles"])) {
    if ( ob_get_length() == 0 ){
        if (isset($_SESSION['clave'])) {
            crudOrdenar($_SESSION['clave']);
        } else {
            $db = AccesoDatos::getModelo();
            $posini = $_SESSION['posini'];
            $tvalores = $db->getClientes($posini,FPAG);
            require_once "app/views/list.php";   
        }
    }
} else if (!isset($_SESSION["primer"]) && !isset($_SESSION["registro"])) {
    $contenido = readfile("app/views/inicio.php");
} else if (isset($_SESSION["roles"])) {
    $db = AccesoDatos::getModelo();
    $posiniU = $_SESSION['posiniU'];
    $tvalores = $db->getUsuarios($posiniU,FPAG);
    require_once "app/views/listRoles.php";  
}
$contenido = ob_get_clean();

// Muestro la página principal con el contenido generado
require_once "app/views/principal.php";



