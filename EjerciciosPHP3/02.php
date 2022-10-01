<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
	<?php
	$medios=["El Pais" => "https://elpais.com/", "La Razon" => "https://www.larazon.es", "ABC" => "https://www.abc.es/", "La Vanguardia" => "https://www.lavanguardia.com/", "El Mundo" => "https://www.elmundo.es/"];
	?>
	<a href="<?php echo $medios["El Pais"]?>">El Pais</a><br>
	<a href="<?php echo $medios["La Razon"]?>">La Razon</a><br>
	<a href="<?php echo $medios["ABC"]?>">ABC</a><br>
	<a href="<?php echo $medios["La Vanguardia"]?>">La Vanguardia</a><br>
	<a href="<?php echo $medios["El Mundo"]?>">El Mundo</a>
</body>
</html>
