<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
	<?php
	$medios=["El Pais" => "https://elpais.com/", "La Razon" => "https://www.larazon.es", "ABC" => "https://www.abc.es/", "La Vanguardia" => "https://www.lavanguardia.com/", "El Mundo" => "https://www.elmundo.es/"];
	$medio=array_rand($medios, 2);
	echo $medio[0];
	?>
	<p>El Medio de hoy es: <a href="<?php echo $medios[$medio[0]]?>"><?php echo $medio[0] ?></a></p>
</body>
</html>
