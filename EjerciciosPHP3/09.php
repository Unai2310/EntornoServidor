<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style>
	body {
		background: #D5FFFF;
	}
	
	table, tr, td {
		border-collapse: collapse;
		border: 1px solid black;
		font-family: "Times New Roman";
	}
	</style>
</head>
<body>
	<h1>Historial de temperaturas</h1>
	<table>
	<?php
	$temperaturas=[6, 10, 12, 14, 16, 20, 25, 30, 18, 15, 14, 8];
	$meses=["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
	$tempmes=[];
	for ($i=0;$i<12;$i++) {
		$tempmes[$meses[$i]]=$temperaturas[$i];
	}
	foreach ($tempmes as $mes => $temp) {
		echo "<tr>";
		echo "<td>".$mes."</td>";
		echo "<td>";
		for ($i=0;$i<$temp;$i++) {
			echo "<img src=\"pixel.png\">";
		}
		echo " ".$temp." ºC</td>";
		echo "</tr>";
	}	
	?>
	</table>
</body>
</html>
