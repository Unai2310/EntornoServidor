<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<h1>Pais con mas poblacion: </h1>
	<?php
	require_once('infopaises.php');
	$max=0;
	$plob="";
	foreach ($paises as $pais => $info) {
		if ($info["Poblacion"]>$max ) {
			$max = $info["Poblacion"]; 
			$plob = $pais;
		}	
	}
	echo $plob."<br>";
	echo "<h1>Y estas son sus ciudades: </h1><br>";
	foreach ($ciudades[$plob] as $cid) {
		echo $cid.", ";
	}

	?>
</body>
</html>
