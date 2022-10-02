<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<h1>Pais 1 seleccionado al azar: </h1>
	<?php
	require_once('infopaises.php');
	$pais=array_rand($paises, 2);
	echo $pais[0]."<br>";
	echo "<h1>Esta es la informacion de ".$pais[0]."</h1><br>";
	foreach ($paises[$pais[0]] as $info) {
		print_r($info);
		echo " ";
	}
	foreach ($ciudades[$pais[0]] as $info) {
		print_r($info);
		echo " ";
	}
	echo "<br><a href=\"https://www.google.es/maps/place/".$pais[0]."\">Visita este lugar en Google Maps</a>";
	echo "<hr>";
	echo "<h1>Pais 2 seleccionado al azar: </h1><br>";
	echo $pais[1]."<br>";
	echo "<h1>Esta es la informacion de ".$pais[1]."</h1><br>";
	foreach ($paises[$pais[1]] as $info) {
		print_r($info);
		echo " ";
	}
	foreach ($ciudades[$pais[1]] as $info) {
		print_r($info);
		echo " ";
	}
	echo "<br><a href=\"https://www.google.es/maps/place/".$pais[1]."\">Visita este lugar en Google Maps</a>";
	?>
</body>
</html>
