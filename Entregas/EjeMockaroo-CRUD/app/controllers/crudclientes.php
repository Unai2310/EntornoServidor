<?php
require_once ('funciones.php');

function crudBorrar($id)
{
    if ($_SESSION["rol"] == 0) {
        $_SESSION["msg"] = "No tienes permisos para acceder a esta opción";
    } else {
        $db = AccesoDatos::getModelo();
        $tuser = $db->borrarCliente($id);
    }
}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Location: ./");
}
 
function crudAlta(){
    if ($_SESSION["rol"] == 0) {
        $_SESSION["msg"] = "No tienes permisos para acceder a esta opción";
    } else {
        $cli = new Cliente();
        $orden= "Nuevo";
        $btn = "disabled";
        include_once "app/views/formulario.php";
    }
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

function crudVolverU() {
    unset($_SESSION["roles"]);
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
    unset($_SESSION["msg"]);
    $cli = $db->getCliente($id);
    $country = getCountry($cli->ip_address);
    if  (isset($country)) {
        $bandera = "https://flagcdn.com/32x24/".strtolower($country).".png";
    }
    $foto = getFotografia($cli->id);
    include_once "app/views/detalles.php";
}

function crudRoles() {
    $db = AccesoDatos::getModelo();
    $tvalores = $db->getUsuarios($_SESSION['posiniU'],FPAG);
    $_SESSION["roles"] = "r";
    require_once "app/views/listRoles.php"; 
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

    if (!isset($_SESSION["intentos"])) {
        $_SESSION["intentos"] = 1;
    }

    $_SESSION["primer"] = "1";

    if ($_SESSION["intentos"] == 3) {
        $msg = "Has agotado todos los intentos. Reinicia el navegador para volver a intentarlo.";
        require_once "app/views/inicio.php"; 
    } else {
        if ($login == "" || $contra == "") {
            $msg = "Faltan campos por rellenar";
            require_once "app/views/inicio.php"; 
        } else if (!isset($us)) {
            $msg = "El usuario no existe";
            require_once "app/views/inicio.php";
        } else if ($login == $us->login && $contrasenia == $us->passwd) {
            $_SESSION["rol"] = $us->rol;
            $_SESSION["login"] = $us->login;
            $_SESSION["dibujo"] = getDibujo($us->rol);
            if ($_SESSION["rol"]  == 1) {
                $_SESSION["masterbtn"] = "<button type=\"submit\" name=\"orden\" value=\"Roles\"> Roles </button>";
            }
            if (isset($_SESSION['clave'])) {
                crudOrdenar($_SESSION['clave']);
            } else {
                $db = AccesoDatos::getModelo();
                $posini = $_SESSION['posini'];
                $tvalores = $db->getClientes($posini,FPAG);
                require_once "app/views/list.php";   
            }
        } else {
            $msg = "Contraseña incorecta. Te quedan ". 3 - $_SESSION["intentos"]." intentos";
            $_SESSION["intentos"] += 1;
            require_once "app/views/inicio.php"; 
        }
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
    if ($_SESSION["rol"] == 0) {
        $_SESSION["msg"] = "No tienes permisos para acceder a esta opción";
    } else {
        $db = AccesoDatos::getModelo();
        $cli = $db->getCliente($id);
        $orden="Modificar";
        if (isset($cli)) {
            $foto = getFotografia($cli->id);
            include_once "app/views/formulario.php";
        }
    }
}

function crudImprimir($datos) {
    $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../uploads']);
    $pdf = getContenido($datos);
    $mpdf->WriteHTML($pdf);
    $mpdf->Output();
}

function crudPostCambiar($logins) {
    foreach ($logins as $log) {
        $db = AccesoDatos::getModelo();
        $user = $db->existeUser($log);
        if ($user->rol == 0) {
            $nuevorol = 1;
        } else {
            $nuevorol = 0;
        }
        $db->cambiarRol($nuevorol,$user->login);
        if ($user->login == $_SESSION["login"]) {
            $_SESSION["rol"] = $nuevorol;
            if ($nuevorol == 0) {
                unset($_SESSION["masterbtn"]);
                unset($_SESSION["roles"]);
            } else {
                $_SESSION["masterbtn"] = "<button type=\"submit\" name=\"orden\" value=\"Roles\"> Roles </button>";
            }
        }
        $icono = $db->existeUser($_SESSION["login"]);
        $_SESSION["dibujo"] = getDibujo($icono->rol);
    }
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
