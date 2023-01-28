<?php
require_once __DIR__."/../composer/vendor/autoload.php";

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

function getFotografia($id) {
    if ($id != "") {
        if (file_exists("app/uploads/".$id.".jpg")) {
            return "app/send_img.php?id=".$id.".jpg";
        } else {
            return "https://robohash.org/".$id;
        }
    }
}

function subirImagen($archive, $id) {
    $temp = $archive["archivo"]["tmp_name"];
    $tamanio = $archive["archivo"]["size"];
    if (is_dir("app/uploads") && is_writable("app/uploads")) {
        
        if (file_exists("app/uploads/" . $id . ".jpg") && $tamanio != 0) {
            unlink("app/uploads/" . $id . ".jpg");
        }

        move_uploaded_file($temp, "app/uploads/" . $id . ".jpg");
    }
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
    $nombre = $archive["archivo"]["name"];
    $tamanio = $archive["archivo"]["size"];
    $tipo = $archive["archivo"]["type"];
    $error = $archive["archivo"]["error"];

    if ($tamanio == 0) {
        if ($tipo == "" && $nombre != "") {
            return "El tamaño del fichero es demasiado grande (1Mb)";
        } else {
            return true;   
        }
    }

    if ($error > 0) {
        return $codigosErrorSubida[$error];
    } else if ($tamanio > 1000000) {
        return "El tamaño del fichero es demasiado grande (1Mb)";
    } else if ($tipo != "image/jpeg") {
        return "El formato de la imagen no es correcto (JPG)";
    } 
    return true;
}

function getContenido($datos) {
    $id = $datos["id"];
    $nombre = $datos["first_name"];
    $apellido = $datos["last_name"];
    $email = $datos["email"];
    $genero = $datos["gender"];
    $ip = $datos["ip_address"];
    $tel = $datos["telefono"];
    $foto = getFotografia($id);

    $html = "<style type=\"type/css\">";
    $html .= "table { width:100%; background: #eee; padding: 10px; font-size: 13px; font-family: tahoma; border-spacing 0; }";
    $html .= "th { background-color: #ddd; padding: 4px; width: 100px; }";
    $html .= "td { padding: 4px; border-bottom: solid thin #ddd; }";
    $html .= "</style>";
    $html .= "<div style=\"font-family: tahoma;\">";
    $html .= "<center><h2>Usuario nº " . $id."</h2></center>";
    $html .= "<table>";
    $html .= "<tr><td rowspan=\"6\"><img src=\"".$foto."\" style=\"opacity: 0.9; width: 200px;\"></td><th>Nombre</th><td>".$nombre."</td></tr>";
    $html .= "<tr><th>Apellidos</th><td>".$apellido."</td></tr>";
    $html .= "<tr><th>Email</th><td>".$email."</td></tr>";
    $html .= "<tr><th>Genero</th><td>".$genero."</td></tr>";
    $html .= "<tr><th>IP</th><td>".$ip."</td></tr>";
    $html .= "<tr><th>Telefono</th><td>".$tel."</td></tr>";
    $html .= "</table></div>";

    return $html;
}

function getDibujo($rol) {
    if ($rol == 0) {
        return "👤";
    } else {
        return "🔑";
    }
}

?>