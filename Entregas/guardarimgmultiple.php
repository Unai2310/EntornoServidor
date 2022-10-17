<html>
<head>
<title>Procesa una subida de archivos </title>
<meta charset="UTF-8">
</head>
<?php
// se incluyen esta tabla de  códigos de error que produce la subida de archivos en PHPP
// Posibles errores de subida segun el manual de PHP
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
$mensaje = '';
$numkb = 0;
$dirdestino = "/imgusers";

// No se recibe nada, error al enviar el POST, se supera post_max_size
if (count($_POST) == 0 ){
   	$mensaje= "  Error: se supera el tamaño máximo de un petición POST <br>";
} else {
	for ($i=0;$i<count($_FILES['archivos']['name']);$i++) {
		$tamanio=$_FILES['archivos']['size'][$i];
		$nombre=$_FILES['archivos']['name'][$i];
		$tipo=$_FILES['archivos']['type'][$i];
		$temp=$_FILES['archivos']['tmp_name'][$i];
		$error=$_FILES['archivos']['error'][$i];	

		if ($tamanio > 200000 || $numkb+$tamanio > 300000) {
			$mensaje.="El archivo supera el limite de tamaño establecido<br>";
		} else if ($tipo != "image/png" && $tipo != "image/jpeg") {
			$mensaje.="El formato no es el esperado. Envie PNG o JPG<br>";
		} else if ($error > 0) {
			$mensaje.="Se ha producido un error en la subida del fichero: ".$codigosErrorSubida[$_FILES['archivos']['error'][$i]]."<br>";
		} else if (is_dir($dirdestino) && is_writable($dirdestino)) {
			if (file_exists($dirdestino."/".$nombre)) {
				$mensaje.="Archivo duplicado<br>";
			} else if (move_uploaded_file($temp, $dirdestino."/".$nombre) == true) {
				$mensaje.="Archivo guardado en: ".$dirdestino."/".$nombre."<br>";
				$numkb+=$tamanio;			
			} else {
				$mensaje.="Archivo no gardado correctamente<br>";
			}
		} else {
			$mensaje.="NO es undirectorio o no se tiene permiso de escritura<br>";
		}
   	}
}

?>


<body>
<?= $mensaje; ?>
</body>
</html>
