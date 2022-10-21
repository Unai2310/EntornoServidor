<?php
include_once 'app/funciones.php';
$sinetiqueta=quitarEtiquetas($_REQUEST['comentario']);

$comentario=strtolower($sinetiqueta);
?>


<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen($comentario) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?= str_word_count($comentario,0) ?></td></tr>
<tr><td>Letra + repetida:  </td><td><?= cuentaLetras($comentario) ?></td></tr>
<tr><td>Palabra + repetida:</td><td><?=cuentaPalabras($comentario) ?></td></tr>
</table>
</div>

