<?php
$error = false;
resetCookies();
var_dump($_COOKIE);

if ( $_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_REQUEST['listafrutas'])){
        resetCookies();
        include ("ej03Info.php");
    } else {
        
        $frutas = $_REQUEST['listafrutas'];
        foreach ($frutas as $fruta) {
            cambiarCookie($fruta, "selected");
        }
        include ("ej03Info.php");
    }    
}

if ( $_SERVER["REQUEST_METHOD"] == 'GET' or $error ){
    include ("ej03Info.php");
}  

function cambiarCookie($fruta, $contendio) {
    setcookie($fruta, $contendio, time() + 86400, "/");
}

function resetCookies() {
    setcookie("Platano", "", time() + 86400, "/");
    setcookie("Naranja", "", time() + 86400, "/");
    setcookie("Fresa", "", time() + 86400, "/");
    setcookie("Manzana", "", time() + 86400, "/");
    setcookie("Melon", "", time() + 86400, "/");
}
?>