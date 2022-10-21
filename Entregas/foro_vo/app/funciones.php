<?php
function usuarioOk($usuario, $contrasenia) :bool {
  
  return ($usuario == strrev($contrasenia)); 
}

function quitarEtiquetas($cadena) :String {
  return strip_tags($cadena);
}

function cuentaLetras($cadena) :String {
  $arr = str_split($cadena);
  $letras = [];
  foreach ($arr as $letra) {
    if (!array_key_exists($letra,$letras)) {
      $letras[$letra]=0;
    }
    $letras[$letra]+=1;
  }
  arsort($letras);
  return array_key_first($letras);
}

function cuentaPalabras($cadena) :String {
  $partes = explode(" ", $cadena);
  $words = [];
  foreach ($partes as $palabra) {
    if (!array_key_exists($palabra, $words)) {
      $words[$palabra]=0;
    }
    $words[$palabra]+=1;
  }
  arsort($words);
  return array_key_first($words);
}
?>
