<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<?php
	require_once('infopaises.php');
	echo "<h1>Ultimo pais del array despues de ordenar </h1><br>";
	ksort($paises);
	echo array_key_last($paises).":";
	print_r($paises[array_key_last($paises)]);
	?>
</body>
</html>
