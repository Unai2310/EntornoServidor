<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<style>
		table,td {
			border: 1px solid black;
			border-collapse:collapse;
			padding:5px;
		}
	</style>
</head>
<body>
	<h1>Array de numeros aleatorios</h1>
	<table>
	<tr>
	<?php
	$numeros=[];
	for ($i=0;$i<20;$i++) {
		$numeros[]=random_int(1,10);
		echo "<td>".$numeros[$i]."</td>";	
	}
	?>
	</tr>
	</table>
	<?php
	sort($numeros);
	echo "<h3>El numero mas grande generado ha sido: ".$numeros[0]."</h3>";
	echo "<h3>El numero mas pequeño generado ha sido : ".$numeros[19]."</h3>";
	$repes=[ 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0];
	foreach ($numeros as $num) {
		$repes[$num] += 1;
	}
	arsort($repes);
 	echo "<h3>El numero generado que mas veces se ha repetido es :".array_key_first($repes)."</h3>";
	?>
</body>
</html>

