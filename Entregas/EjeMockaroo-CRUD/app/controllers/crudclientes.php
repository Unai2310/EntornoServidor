<?php
require_once ('funciones.php');

function crudBorrar ($id){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarCliente($id);
}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Location: ./");

}
 
function crudAlta(){
    $cli = new Cliente();
    $orden= "Nuevo";
    $btn = "disabled";
    include_once "app/views/formulario.php";
}

function crudRegistro(){
    $us = new User();
    $orden= "Registrar";
    $_SESSION["registro"] = "r";
    unset($_SESSION["primer"]);
    include_once "app/views/registro.php";
}

function crudVolver(){
    unset($_SESSION["registro"]);
}

function crudOrdenar($clave) {
    $db = AccesoDatos::getModelo();
    $posini = $_SESSION['posini'];
    $_SESSION['clave'] = $clave;
    $tvalores = $db->getClientesOrden($clave,$posini,FPAG);
    require_once "app/views/list.php";   
}

function crudDetalles($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $country = getCountry($cli->ip_address);
    if  (isset($country)) {
        $bandera = "https://flagcdn.com/32x24/".strtolower($country).".png";
    }
    $foto = getFotografia($cli->id);
    include_once "app/views/detalles.php";
}

function crudDetallesSiguiente($id,$clave){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id,$clave);
    if (isset($cli)) {
        $country = getCountry($cli->ip_address);
        if  (isset($country)) {
            $bandera = "https://flagcdn.com/32x24/".strtolower($country).".png";
        }
        $foto = getFotografia($cli->id);
        include_once "app/views/detalles.php";
    }
}

function crudIngreso($login,$contra) {
    $db = AccesoDatos::getModelo();
    $us = $db->existeUser($login);

    $contrasenia = sha1($contra);

    $_SESSION["primer"] = "1";

    if ($login == "" || $contra == "") {
        $msg = "Faltan campos por rellenar";
        require_once "app/views/inicio.php"; 
    } else if (!isset($us)) {
        $msg = "El usuario no existe";
        require_once "app/views/inicio.php";
    } else if ($login == $us->login && $contrasenia == $us->passwd) {
        $_SESSION["login"] = $login;
        if (isset($_SESSION['clave'])) {
            crudOrdenar($_SESSION['clave']);
        } else {
            $db = AccesoDatos::getModelo();
            $posini = $_SESSION['posini'];
            $tvalores = $db->getClientes($posini,FPAG);
            require_once "app/views/list.php";   
        }
    } else {
        $msg = "Contraseña incorecta";
        require_once "app/views/inicio.php"; 
    }
}

function crudDetallesAnterior($id,$clave){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id,$clave);
    if (isset($cli)) {
        $country = getCountry($cli->ip_address);
        if  (isset($country)) {
            $bandera = "https://flagcdn.com/32x24/".strtolower($country).".png";
        }
        $foto = getFotografia($cli->id);
        include_once "app/views/detalles.php";
    }
}

function crudModificarSiguiente($id,$clave){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id,$clave);
    $orden="Modificar";
    if (isset($cli)) {
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    }
}

function crudModificarAnterior($id,$clave){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id,$clave);
    $orden="Modificar";
    if (isset($cli)) {
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    }
}

function crudModificar($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden="Modificar";
    if (isset($cli)) {
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    }
}

function crudImprimir($datos) {
    $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../uploads']);
    $pdf = getContenido($datos);
    $mpdf->WriteHTML($pdf);
    $mpdf->Output();
}

function crudPostRegistro(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $us = new User();
    $us->login    =$_POST['login'];
    $us->passwd   = sha1($_POST['passwd']);
    $us->rol = 0;
    $db = AccesoDatos::getModelo();
    $repe = $db->existeUser($us->login);

    if ($us->login == "" || $us->passwd == "") {
        $msg = "Hay algun campo vacio, por favor rellenalos todos para poder continuar";
        $orden = "Registrar";
        include_once "app/views/registro.php";
    }else if ($repe) {
        $msg = "El login esta repetido, por favor introduce otro";
        $orden = "Registrar";
        include_once "app/views/registro.php";
    } else {
        unset($_SESSION["registro"]);
        $db->addUser($us);
    }
}

function crudPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();
    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    $db = AccesoDatos::getModelo();
    $imagen = comprobarFichero($_FILES);
    if ($cli->first_name=="" || $cli->last_name=="" || $cli->email=="" || $cli->gender=="" || $cli->ip_address=="" || $cli->telefono=="") {
        $msg = "Hay algun campo vacio, por favor rellenalos todos para poder continuar";
        $orden = "Nuevo";
        $btn = "disabled";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    }else if ($db->emailRepetido($_POST['email'])) {
        $msg = "El email introducido esta repetido en la base de datos";
        $orden = "Nuevo";
        $btn = "disabled";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else if (!regexEmail($_POST['email'])) {
        $msg = "El email introducido no tiene un formato correcto";
        $orden = "Nuevo";
        $btn = "disabled";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else if (!regexIp($_POST['ip_address'])){
        $msg = "La dirección IP introducida no tiene un formato correcto";
        $orden = "Nuevo";
        $btn = "disabled";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else if (!regexTel($_POST['telefono'])) {
        $msg = "El telefono introducido no tiene un formato correcto";
        $orden = "Nuevo";
        $btn = "disabled";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else if (!is_bool($imagen)) {
        $msg = $imagen;
        $orden = "Nuevo";
        $btn = "disabled";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else {
        $db->addCliente($cli);
    }
}

function crudPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();

    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    $db = AccesoDatos::getModelo();
    $imagen = comprobarFichero($_FILES);
    $repetido = $db->emailRepetidoMod($_POST['email']);
    if ($cli->first_name=="" || $cli->last_name=="" || $cli->email=="" || $cli->gender=="" || $cli->ip_address=="" || $cli->telefono=="") {
        $msg = "Hay algun campo vacio, por favor rellenalos todos para poder continuar";
        $orden = "Modificar";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    }else if ($repetido[0] != $cli->id && isset($repetido)) {
        $msg = "El email introducido esta repetido en la base de datos";
        $orden = "Modificar";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else if (!regexEmail($_POST['email'])) {
        $msg = "El email introducido no tiene un formato correcto";
        $orden = "Modificar";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else if (!regexIp($_POST['ip_address'])){
        $msg = "La dirección IP introducida no tiene un formato correcto";
        $orden = "Modificar";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else if (!regexTel($_POST['telefono'])) {
        $msg = "El telefono introducido no tiene un formato correcto";
        $orden = "Modificar";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else if (!is_bool($imagen)) {
        $msg = $imagen;
        $orden = "Modificar";
        $foto = getFotografia($cli->id);
        include_once "app/views/formulario.php";
    } else {
        subirImagen($_FILES, $cli->id);
        $db->modCliente($cli);
    }
}
