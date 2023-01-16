<?php
require_once('funciones.php');
function crudBorrar ($id){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarCliente($id);
}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function crudAlta(){
    $cli = new Cliente();
    $orden= "Nuevo";
    include_once "app/views/formulario.php";
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
        include_once "app/views/detalles.php";
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
        include_once "app/views/detalles.php";
    }
}

function crudModificarSiguiente($id,$clave){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id,$clave);
    $orden="Modificar";
    if (isset($cli)) {
        include_once "app/views/formulario.php";
    }
}

function crudModificarAnterior($id,$clave){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id,$clave);
    $orden="Modificar";
    if (isset($cli)) {
        include_once "app/views/formulario.php";
    }
}


function crudModificar($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden="Modificar";
    include_once "app/views/formulario.php";
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
    
    $db->addCliente($cli);
    
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
    $db->modCliente($cli);
    
}
