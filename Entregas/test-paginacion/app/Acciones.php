<?php

require_once('AccesoDatos.php');
require_once('Cliente.php');
require_once('AccesoDatos.php');


function accionDetalles($id){
    $midb = AccesoDatos::getModelo();
    $cliente = $midb->getCliente($id);
    $orden = "Detalles";
    include_once "plantillas/formulario.php";
    exit();
}

function accionModificar($columna) {
    $midb = AccesoDatos::getModelo();
    $cliente = $midb->getCliente($columna);
    $orden = "Modificar";
    include_once "plantillas/formulario.php";
    exit();
}

function accionPostModificar() {
    limpiarArrayEntrada($_POST);
    $cliente = new Cliente();
    $cliente->id = $_POST['id'];
    $cliente->first_name = $_POST['first_name'];
    $cliente->last_name = $_POST['last_name'];
    $cliente->email = $_POST['email'];
    $cliente->gender = $_POST['gender'];
    $cliente->ip_address = $_POST['ip'];
    $cliente->telefono = $_POST['tel'];

    $midb = AccesoDatos::getModelo();
    $error = $midb->modUsuario($cliente);
    if ($error) {
        $_SESSION['msg'] = "El usuario con id ".$cliente->id." ha sido modificado";
    } else {
        $_SESSION['msg'] = "No se ha podido modificar el cliente con id ".$cliente->id;
    }
}

function accionBorrar($id) {
    $midb = AccesoDatos::getModelo();
    $err = $midb->borrarUsuario($id);
    if ($err) {
        $_SESSION['msg'] = "El usuario con id ".$id." se ha eliminado";
    } else {
        $_SESSION['msg'] = "El usuario con id ".$id." no se ha eliminado";
    }
}

function accionAlta(){
    $orden = "Crear";
    include_once "plantillas/formulario.php";
    exit();
}

function accionPostAlta()
{
    limpiarArrayEntrada($_POST);
    $cliente = new Cliente();
    $cliente->id = $_POST['id'];
    $cliente->first_name = $_POST['first_name'];
    $cliente->last_name = $_POST['last_name'];
    $cliente->email = $_POST['email'];
    $cliente->gender = $_POST['gender'];
    $cliente->ip_address = $_POST['ip'];
    $cliente->telefono = $_POST['tel'];
    $midb = AccesoDatos::getModelo();
    $error = $midb->addUsuario($cliente);
    if ($error) {
        $_SESSION['msg'] = "El usuario con id ".$cliente->id." ha sido creado";
    } else {
        $_SESSION['msg'] = "No se ha podido crear el cliente con id ".$cliente->id;
    }
}


function limpiarArrayEntrada(array &$entrada){
    foreach ($entrada as $clave => $valor) {
      $entrada[$clave] = htmlspecialchars($valor);
    } 
}