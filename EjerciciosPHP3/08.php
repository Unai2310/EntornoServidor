<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style>
	table, tr, td {
		border-collapse: collapse;
		border: 1px solid black;
	}
	</style>
</head>
<body>
	<h1>Tabla de paises: </h1>
	<table>
	<tr>
	<td>PAIS</td><td>CAPITAL</td><td>POBLACION</td><td>CIUDADES</td>
	</tr>
	<?php
	require_once('infopaises.php');
	foreach ($paises as $pais => $info) {
		echo "<tr>";
		echo "<td>".$pais."</td>";
		echo "<td>".$info["Capital"]."</td>";
		echo "<td>".$info["Poblacion"]."</td>";
		echo "<td>";
		foreach ($ciudades[$pais] as $ciudad) {
			echo $ciudad." ";
		}
		echo "</td>";
	}
	echo "</tr>";
	?>
	</table>
</body>
</html>
