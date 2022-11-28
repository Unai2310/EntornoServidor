<?php
$nombres = ["Juan","Pedro","María","Elena","Luis"];
$notas  = [7.5, 6.0, 7.8, 9.5, 3.5 ];
// Une los array en uno nuevo
$calificaciones = unir ($nombres, $notas);
// Creo un nuevo array
$datos = separar($calificaciones);
echo "<code><pre>";
print_r($calificaciones);
print_r($datos);
echo "</pre></code>";

function unir ($arr1, $arr2) {
    $arrnuevo = [];
    for ($i=0;$i<count($arr1);$i++) {
        $arrnuevo[$arr1[$i]] = $arr2[$i];
    }
    return $arrnuevo;
}

function separar($arr) {
    $arr1 = array_keys($arr);
    $arr2 = array_values($arr);
    $arrnuevo = [$arr1, $arr2];
    return $arrnuevo;
}

?>