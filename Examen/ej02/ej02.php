<?php
$error = false;
session_start();

if ( $_SERVER["REQUEST_METHOD"] == 'POST' && $_POST['orden'] == "Consultar"){
    if (empty($_REQUEST['nombre'])){
        $msg ="Introduce un nombre para consutar.<br> ";
        $error = true;
    } else {
        checkCSRF();
        $nombre = $_REQUEST['nombre'];
        $telefono = $_REQUEST['telefono'];
        $msg = buscarDatostxt($_REQUEST['nombre']);
        include("ej02Entrada.php");
    }    
}

if ( $_SERVER["REQUEST_METHOD"] == 'POST' && $_POST['orden'] == "Añadir"){
    if (empty($_REQUEST['nombre']) || empty($_REQUEST['telefono'])){
        $msg ="Rellena todos los campos para añadir un contacto.<br> ";
        $error = true;
    } else {
        checkCSRF();
        $nombre = $_REQUEST['nombre'];
        $telefono = $_REQUEST['telefono'];
        $msg = escribirtxt($_REQUEST['nombre'], $_REQUEST['telefono']);
        include("ej02Entrada.php");
    }    
}

if ( $_SERVER["REQUEST_METHOD"] == 'GET' or $error ){
    include ("ej02Entrada.php");
}    


function buscarDatostxt($contacto){
    $tabla=[]; 
    if (!is_readable("files/contactos.txt") ){
        $fich = @fopen("files/contactos.txt","w") or die ("Error al crear el fichero.");
        fclose($fich);
    }
    $fich = @fopen("files/contactos.txt", 'r') or die("ERROR al abrir fichero de contactos");
    
    while ($linea = fgets($fich)) {
        $partes = explode(',', trim($linea));
        $tabla[$partes[0]] = $partes[1];
    }
    fclose($fich);
    $respuesta = "";
    if (array_key_exists($contacto, $tabla)) {
        $respuesta = $tabla[$contacto];
    }
    if ($respuesta != "") {
        return "El telefono de ".$contacto." es ".$respuesta;
    } else {
        return "No se encuentra a ".$contacto." en la agenda";
    }
}

function escribirtxt($nombre, $tel){
    if (is_numeric($tel) && strlen($tel) == 9) {
        file_put_contents("files/contactos.txt", $nombre.",".$tel."\n", FILE_APPEND);   
        return "El contacto se ha añadido";
    } else {
        return "El telefono no tiene el formato correcto";
    }
}

function checkCSRF(){
    if ( !isset($_REQUEST['token']) || $_REQUEST['token'] != $_SESSION['token']){
        exit();
    }
}
?>