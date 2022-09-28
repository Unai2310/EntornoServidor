<?php

echo "Nº de filas ".$_REQUEST["filas"]."<br>";
echo "Nº de columnas ".$_REQUEST["columnas"]."<br>";
echo "Grosor del borde ".$_REQUEST["borde"]."<br>";
echo "Contenido de las celdas ".$_REQUEST["contenido"]."<br>";

generarTablaHTML($_REQUEST["filas"], $_REQUEST["columnas"], $_REQUEST["borde"], $_REQUEST["contenido"]);


function generarTablaHTML($filas, $columnas, $borde, $contenido) {
	$html="<table style=\"border:".$borde."px solid black\",\"cellspacing:0\"";
	for ($i=0;$i<$filas;$i++) {
		$html.="<tr border=".$borde."px solid black>";
		for ($j=0;$j<$columnas;$j++) {
			$html.="<th>".$contenido."</th>";
		}
		$html.="</tr>";
	}
	$html.="</table>";
	echo $html;
}



?>

