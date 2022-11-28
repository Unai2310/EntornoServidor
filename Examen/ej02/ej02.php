<?php
$error = false;
if ( $_SERVER["REQUEST_METHOD"] == 'POST' && $_POST['orden'] == "Consultar"){
    if (empty($_REQUEST['nombre'])){
        $msg ="Introduce un nombre para consutar.<br> ";
        $error = true;
    } else {
        $msg =buscarDatostxt($_REQUEST['nombre']);
        include("ej02Entrada.php");
    }    
}

if ( $_SERVER["REQUEST_METHOD"] == 'GET' or $error ){
    include ("ej02Entrada.php");
}    


function buscarDatostxt($contacto){
    $tabla=[]; 
    if (!is_readable("files/contactos.txt") ){
        $fich = @fopen(FILEUSER,"w") or die ("Error al crear el fichero.");
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

?>