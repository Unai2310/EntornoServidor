<html>
	<head>
	<title>Cuadrados de colores</title>
	<style>
	body {
		background: silver;
		text-align: justify;
		font-family: Tahoma, Geneva, sans-serif;
		font-size: 14px;
		color: #757E82;
	}

	table, th, td {
	  border: 1px solid black;
	} 
	</style>
	</head>
	<body>
	<h1>Tablero de colores</h1>
		<table>
			<?php
			$rojo = random_int(0,255);
			$verde = random_int(0,255);
			$azul = random_int(0,255);
			function dameColor(&$rojo, &$verde, &$azul){
				$rojo += 3;
				$verde += 3;
				$azul+= 3;

				$color = "rgb(".$rojo.",".$verde.",".$azul.")";
				return $color;
			}
			for ($i =1; $i<=10; $i++){
				echo "<tr>";
				for ($j = 1; $j<=10; $j++){
				    $color = dameColor($rojo, $verde, $azul);
				    echo "<td style=\"background-color:$color; height:40px; width:40px\"></td>";
				}
				echo "</tr>";
			}
		    ?>
        </table>
	</body>
</html>
