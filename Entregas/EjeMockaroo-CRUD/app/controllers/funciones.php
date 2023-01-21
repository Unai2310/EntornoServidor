<?php

function getCountry($ip) {
    $url = "http://ip-api.com/json/$ip";
    $json_data = file_get_contents($url);
    $response_data = json_decode($json_data,true);
    if (array_key_exists("countryCode",$response_data)) {
        return $response_data['countryCode'];
    }
}

function regexIp($ip) {
    return preg_match("/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/",$ip);
}

function regexTel($tel) {
    return preg_match("/^\d{3}-\d{3}-\d{4}$/",$tel);
}

function regexEmail($email) {
    return preg_match("/^\S+@\S+\.\S+$/",$email);
}

function comprobarFichero($archive) {
    $codigosErrorSubida= [ 
            UPLOAD_ERR_OK         => 'Subida correcta',  // Valor 0
            UPLOAD_ERR_INI_SIZE   => 'El tamaño del archivo excede el admitido por el servidor',  // directiva upload_max_filesize en php.ini
            UPLOAD_ERR_FORM_SIZE  => 'El tamaño del archivo excede el admitido por el cliente',  // directiva MAX_FILE_SIZE en el formulario HTML
            UPLOAD_ERR_PARTIAL    => 'El archivo no se pudo subir completamente',
            UPLOAD_ERR_NO_FILE    => 'No se seleccionó ningún archivo para ser subido',
            UPLOAD_ERR_NO_TMP_DIR => 'No existe un directorio temporal donde subir el archivo',
            UPLOAD_ERR_CANT_WRITE => 'No se pudo guardar el archivo en disco',  // permisos
            UPLOAD_ERR_EXTENSION  => 'Una extensión PHP evito la subida del archivo',  // extensión PHP
    ];
    $tamanio = $_FILES['archivos']['size'];
    $nombre = $_FILES['archivos']['name'];
    $tipo=$_FILES['archivos']['type'];
    $temp=$_FILES['archivos']['tmp_name'];
    $error=$_FILES['archivos']['error'];
}

?>